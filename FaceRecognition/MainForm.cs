using System;
using System.Collections.Generic;
using System.Drawing;
using System.Windows.Forms;
using Emgu.CV;
using Emgu.CV.Structure;
using Emgu.CV.CvEnum;
using System.IO;
using System.Diagnostics;
using MySql.Data.MySqlClient;
using System.Data;

using System.IO.Ports;


using FaceRecognition.DataLayer;
using System.Timers;
using Timer = System.Timers.Timer;
using FaceRecognition.Services;
using System.Xml.Linq;

namespace FaceRecognition
{
    public partial class FaceDetect : Form
    {
        private DL_TimeRegistration data;

        public string SQL, fileNameimg, comportno, numberOfFaceDetected, empStat, countInOut;
        System.IO.Ports.SerialPort SerialPort1 = new System.IO.Ports.SerialPort();

        //Declararation of all variables, vectors and haarcascades
        Image<Bgr, Byte> currentFrame;
        Capture grabber;
        HaarCascade face;
        HaarCascade eye;
        MCvFont font = new MCvFont(FONT.CV_FONT_HERSHEY_TRIPLEX, 0.5d, 0.5d);
        Image<Gray, byte> result, TrainedFace = null;
        Image<Gray, byte> gray = null;
        List<Image<Gray, byte>> trainingImages = new List<Image<Gray, byte>>();
        List<string> labels = new List<string>();
        List<string> NamePersons = new List<string>();
        int ContTrain, NumLabels, t;
        string name, names = null;

        public FaceDetect()
        {
            InitializeComponent();
            face = new HaarCascade("haarcascade_frontalface_default.xml");
            try
            {
                //Load of previus trainned faces and labels for each image
                string Labelsinfo = File.ReadAllText(Application.StartupPath + "/TrainedFaces/TrainedLabels.txt");
                string[] Labels = Labelsinfo.Split('%');
                NumLabels = Convert.ToInt16(Labels[0]);
                ContTrain = NumLabels;
                string LoadFaces;

                for (int tf = 1; tf < NumLabels + 1; tf++)
                {
                    LoadFaces = "face" + tf + ".bmp";
                    trainingImages.Add(new Image<Gray, byte>(Application.StartupPath + "/TrainedFaces/" + LoadFaces));
                    labels.Add(Labels[tf]);
                }

            }
            catch (Exception)
            {
                MessageBox.Show("Nothing in binary database, please add at least a face(Simply train the prototype with the Add Face Button).", "Triained faces load", MessageBoxButtons.OK, MessageBoxIcon.Exclamation);
            }

        }

        private void StartCapturing()
        {
            grabber = new Capture();
            grabber.QueryFrame();
            Application.Idle += new EventHandler(FrameGrabber);
        }

        void FrameGrabber(object sender, EventArgs e)
        {
            NamePersons.Add("");
            currentFrame = grabber.QueryFrame().Resize(320, 240, Emgu.CV.CvEnum.INTER.CV_INTER_CUBIC);


            gray = currentFrame.Convert<Gray, Byte>();      //Convert it to Grayscale
            MCvAvgComp[][] facesDetected = gray.DetectHaarCascade(  //Face Detector
          face,
          1.2,
          10,
          Emgu.CV.CvEnum.HAAR_DETECTION_TYPE.DO_CANNY_PRUNING,
          new Size(20, 20));

            //Action for each element detected
            foreach (MCvAvgComp f in facesDetected[0])
            {
                t = t + 1;
                result = currentFrame.Copy(f.rect).Convert<Gray, byte>().Resize(100, 100, Emgu.CV.CvEnum.INTER.CV_INTER_CUBIC);
                //draw the face detected in the 0th (gray) channel with blue color
                currentFrame.Draw(f.rect, new Bgr(Color.Red), 2);


                if (trainingImages.ToArray().Length != 0)
                {
                    //TermCriteria for face recognition with numbers of trained images like maxIteration
                    MCvTermCriteria termCrit = new MCvTermCriteria(ContTrain, 0.001);

                    //Eigen face recognizer
                    EigenObjectRecognizer recognizer = new EigenObjectRecognizer(
                       trainingImages.ToArray(),
                       labels.ToArray(),
                       3000,
                       ref termCrit);

                    name = recognizer.Recognize(result);

                    //Draw the label for each face detected and recognized
                    currentFrame.Draw(name, ref font, new Point(f.rect.X - 2, f.rect.Y - 2), new Bgr(Color.LightGreen));

                }

                NamePersons[t - 1] = name;
                NamePersons.Add("");
                numberOfFaceDetected = facesDetected[0].Length.ToString();
            }
            t = 0;

            //Names concatenation of persons recognized
            for (int nnn = 0; nnn < facesDetected[0].Length; nnn++)
            {
                names = names + NamePersons[nnn];
            }
            //Show the faces procesed and recognized
            imageBoxFrameGrabber.Image = currentFrame;

            txtUserNo.Text = names;
            lblUserNo.Text = names;
            names = "";
            //Clear the list(vector) of names
            NamePersons.Clear();

        }

        private void FrmPrincipal_Load(object sender, EventArgs e)
        {
            data = new DL_TimeRegistration();

            timer1.Start();
            dateTimePicker7.Value = DateTime.Now;
            StartCapturing();

            DisplayTimeSheet();
            clr();
        }

        private void txtUserNo_TextChanged(object sender, EventArgs e)
        {
            if (txtUserNo.Text != "")
            {
                button1.Enabled = true;
                Timer3.Start();
            }
            else
            {
                button1.Enabled = false;
                lblname.Text = "";
                txtId.Clear();
            }
        }

        private void Timer3_Tick(object sender, EventArgs e)
        {
            searchUser();
        }

        private void searchUser()
        {
            IUserService _userService = new UserService();

            Timer3.Stop();

            
            var user = _userService.GetUserDetailsByUserNumber(txtUserNo.Text);
            if (user != null || user.username != null)
            {
                lblUserNo.Text = user.userNo;
                lblname.Text = user.lName + ", " + user.fName;
                txtId.Text = Convert.ToString(user.userId);

                SetAttendanceId();

                SetActiveClockButton();

                button1.Enabled = true;
                return;
            }

            else
            {
                clr();
            }
        }

        private void panel2_Paint(object sender, PaintEventArgs e)
        {

        }

        private void panel1_Paint(object sender, PaintEventArgs e)
        {

        }

        void clr()
        {
            dateTimePicker7.Value = DateTime.Now;
            lblname.Text = "INFORMATION";
            lblUserNo.Text = "ID";
            txtUserNo.Text = "";
            txtUserNo.Focus();
            button1.Enabled = false;
        }

        #region TimeInOut.
        private void SetAttendanceId()
        {
            Properties.Settings.Default.attendanceId = data.GetAttendanceId(int.Parse(txtId.Text));
            Properties.Settings.Default.Save();
            Properties.Settings.Default.Reload();
            label1.Text = Properties.Settings.Default.attendanceId.ToString();

            Properties.Settings.Default.userId = (int.Parse(txtId.Text));
            Properties.Settings.Default.Save();
            Properties.Settings.Default.Reload();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            {
                var action = button1.Text;
                var currenttime = DateTime.Now.TimeOfDay;
                var attendanceId = Properties.Settings.Default.attendanceId;


                if (action == "CLOCK IN")
                {
                    var isRecorded = data.ClockIn(currenttime);

                    if (isRecorded)
                    {
                        AutoClosingMessageBox.Show("CLOCK IN has been successfully recorded", "Successful", 4000);
                    }
                    else
                        AutoClosingMessageBox.Show("Invalid  Clock In Action", "Error", 2000);
                }
             
                else if (action == "CLOCK OUT")

                {
                    if (data.IsTotalHoursLessThanOneHour(attendanceId))
                    {
            
                        DialogResult prompt = MessageBox.Show("You have consumed less than an hour from your login time. " +
                               "Are you sure you want to logout?", "Confirmation", MessageBoxButtons.OKCancel, MessageBoxIcon.Question);
                   
                        switch (prompt)
                        {
                            case DialogResult.OK:
                                {
                                    break;
                                }
                            case DialogResult.Cancel:
                                {
                                    return;
                                }
                        }
                    }

                    var isRecorded = data.ClockOut(attendanceId, currenttime);

                    if (isRecorded)
                    {

                        AutoClosingMessageBox.Show("CLOCK OUT has been successfully recorded", "Successful", 4000);

                        Properties.Settings.Default.attendanceId = 0;
                        Properties.Settings.Default.Save();
                        Properties.Settings.Default.Reload();
                        button1.Enabled = false;
                        button1.Text = "CLOCK IN";
                    }
                    else
                        AutoClosingMessageBox.Show("Invalid Clock Out Action", "Error", 2000);
                }
                else
                    AutoClosingMessageBox.Show("Invalid Clock Action", "Error", 2000);


                lblStatus.Text = button1.Text;
                DisplayTimeSheet();
            }
        }


        public void SetActiveClockButton()
        {
            var result = data.GetCurrentDayAttendanceById(Properties.Settings.Default.attendanceId);
            


            if (result != null && result.Rows.Count > 0)
            {
                if (result.Rows[0]["timeIn"] == DBNull.Value)
                {
                    button1.Text = "CLOCK IN";
                    return;
                }

                if (result.Rows[0]["timeOut"] == DBNull.Value || result.Rows[0]["timeOut"].ToString() == "00:00:00.0000000")
                {
                    button1.Text = "CLOCK OUT";
                    return;
                }

            }
        }


        private void DisplayTimeSheet()
        {
            dataGridView1.DataSource = data.GetTimeSheet();
        }

        #endregion

        private void timer1_Tick(object sender, EventArgs e)
        {
            labelTime.Text = DateTime.Now.ToLongTimeString();
            labelDate.Text = DateTime.Now.ToLongDateString();

            lblDate.Text = DateTime.Now.ToLongDateString();
            lblTime.Text = DateTime.Now.ToString("h:mm:ss tt");
            dtpNow.Text = DateTime.Now.ToString("h:mm:ss tt");
        }

        private void button2_Click(object sender, EventArgs e)
        {
            SetActiveClockButton();
        }

        private void button3_Click(object sender, EventArgs e)
        {
            if (dateTimePicker1.Value > dtpNow.Value)
            {
                AutoClosingMessageBox.Show("Mas maaga ka sa iyong oras", "Invalid Time", 3000);
            }
        }

        public class AutoClosingMessageBox
        {
            System.Threading.Timer _timeoutTimer;
            string _caption;
            AutoClosingMessageBox(string text, string caption, int timeout)
            {
                _caption = caption;
                _timeoutTimer = new System.Threading.Timer(OnTimerElapsed,
                    null, timeout, System.Threading.Timeout.Infinite);
                using (_timeoutTimer)
                    MessageBox.Show(text, caption);
            }
            public static void Show(string text, string caption, int timeout)
            {
                new AutoClosingMessageBox(text, caption, timeout);
            }
            void OnTimerElapsed(object state)
            {
                IntPtr mbWnd = FindWindow("#32770", _caption); // lpClassName is #32770 for MessageBox
                if (mbWnd != IntPtr.Zero)
                    SendMessage(mbWnd, WM_CLOSE, IntPtr.Zero, IntPtr.Zero);
                _timeoutTimer.Dispose();
            }
            const int WM_CLOSE = 0x0010;
            [System.Runtime.InteropServices.DllImport("user32.dll", SetLastError = true)]
            static extern IntPtr FindWindow(string lpClassName, string lpWindowName);
            [System.Runtime.InteropServices.DllImport("user32.dll", CharSet = System.Runtime.InteropServices.CharSet.Auto)]
            static extern IntPtr SendMessage(IntPtr hWnd, UInt32 Msg, IntPtr wParam, IntPtr lParam);
        }
    }
}