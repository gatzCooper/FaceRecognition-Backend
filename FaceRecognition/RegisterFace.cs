
using System;
using System.Collections.Generic;
using System.Drawing;
using System.Windows.Forms;
using Emgu.CV;
using Emgu.CV.Structure;
using Emgu.CV.CvEnum;
using System.IO;
using System.Diagnostics;
using System.Data;


using System.Drawing.Imaging;
using Microsoft.VisualBasic;
using FaceRecognition.Model;
using FaceRecognition.DataLayer;
using static System.Windows.Forms.VisualStyles.VisualStyleElement.StartPanel;
using System.Data.SqlClient;
using FaceRecognition.Services;

namespace FaceRecognition
{
    public partial class RegisterFace : Form
    {

        IUserService _userService = new UserService();

        //Declararation of all variables, vectors and haarcascades
        Image<Bgr, Byte> currentFrame;
        Capture grabber;
        HaarCascade face;
        HaarCascade eye;
        MCvFont font = new MCvFont(FONT.CV_FONT_HERSHEY_TRIPLEX, 0.5d, 0.5d);
        Image<Gray, byte> result, TrainedFace = null;
        Image<Gray, byte> gray = null;
        List<Image<Gray, byte>> trainingImages = new List<Image<Gray, byte>>();
        List<string> labels= new List<string>();
        List<string> NamePersons = new List<string>();
        int ContTrain, NumLabels, t;
        string name, names = null;

        public RegisterFace()
        {
            InitializeComponent();
            //Load haarcascades for face detection
            face = new HaarCascade("haarcascade_frontalface_default.xml");
            //eye = new HaarCascade("haarcascade_eye.xml");
            try
            {
                //Load of previus trainned faces and labels for each image
                string Labelsinfo = File.ReadAllText(Application.StartupPath + "/TrainedFaces/TrainedLabels.txt");
                string[] Labels = Labelsinfo.Split('%');
                NumLabels = Convert.ToInt16(Labels[0]);
                ContTrain = NumLabels;
                string LoadFaces;

                for (int tf = 1; tf < NumLabels+1; tf++)
                {
                    LoadFaces = "face" + tf + ".bmp";
                    trainingImages.Add(new Image<Gray, byte>(Application.StartupPath + "/TrainedFaces/" + LoadFaces));
                    labels.Add(Labels[tf]);
                }
            
            }
            catch(Exception e)
            {
                //MessageBox.Show(e.ToString());
              // MessageBox.Show("Nothing in binary database, please add at least a face(Simply train the prototype with the Add Face Button).", "Triained faces load", MessageBoxButtons.OK, MessageBoxIcon.Exclamation);
            }

        }
     
       private void button1_Click(object sender, EventArgs e)
        {
            //Initialize the capture device
            grabber = new Capture();
            grabber.QueryFrame();
            //Initialize the FrameGraber event
            Application.Idle += new EventHandler(FrameGrabber);
          //  button1.Enabled = false;
        }
        void FrameGrabber(object sender, EventArgs e)
        {
            //label4.Text = "";
            NamePersons.Add("");


            //Get the current frame form capture device
            currentFrame = grabber.QueryFrame().Resize(320, 240, Emgu.CV.CvEnum.INTER.CV_INTER_CUBIC);

                    //Convert it to Grayscale
                    gray = currentFrame.Convert<Gray, Byte>();

                    //Face Detector
                    MCvAvgComp[][] facesDetected = gray.DetectHaarCascade(
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

                            NamePersons[t-1] = name;
                            NamePersons.Add("");


                        //Set the number of faces detected on the scene
                      //  label3.Text = facesDetected[0].Length.ToString();

                    }
                        t = 0;

                        //Names concatenation of persons recognized
                    for (int nnn = 0; nnn < facesDetected[0].Length; nnn++)
                    {
                        names = names + NamePersons[nnn];// +", ";
                    }
                    //Show the faces procesed and recognized
                    imageBoxFrameGrabber.Image = currentFrame;
                  
                   // lblIDNumber.Text = names;
                    names = "";
                    //Clear the list(vector) of names
                    NamePersons.Clear();

                }

        public string SQL, msg, lblIDnumber1, ImgExist, ImgLoc;

        private void imageBox1_Click(object sender, EventArgs e)
        {

        }

        public int fileNameimg;

        public string comportno;

        private void maskedTextBox1_MaskInputRejected(object sender, MaskInputRejectedEventArgs e)
        {

        }
    

        private void RegisterFace_Load(object sender, EventArgs e)
        {
            maskedTextBox1.Text = "Enter your username here...";
            maskedTextBox1.ForeColor = Color.Gray;

            button1_Click(sender, e);
        }


        private void btnFaceAdd_Click(object sender, EventArgs e)
        {
            if ( txtname.Text == "" || txtname.Text =="," || txtname.Text == "NO INFORMATION")
            {
                MessageBox.Show("User not found in the database!", "Invalid User", MessageBoxButtons.OK, MessageBoxIcon.Information);
                return;
            }


            try
            {
                //Trained face counter
                ContTrain = ContTrain + 1;

                //Get a gray frame from capture device
                gray = grabber.QueryGrayFrame().Resize(320, 240, Emgu.CV.CvEnum.INTER.CV_INTER_CUBIC);

                //Face Detector
                MCvAvgComp[][] facesDetected = gray.DetectHaarCascade(
                face,
                1.2,
                10,
                Emgu.CV.CvEnum.HAAR_DETECTION_TYPE.DO_CANNY_PRUNING,
                new Size(20, 20));

                //Action for each element detected
                foreach (MCvAvgComp f in facesDetected[0])
                {
                    TrainedFace = currentFrame.Copy(f.rect).Convert<Gray, byte>();
                    break;
                }

                //resize face detected image for force to compare the same size with the 
                //test image with cubic interpolation type method
                TrainedFace = result.Resize(100, 100, Emgu.CV.CvEnum.INTER.CV_INTER_CUBIC);
                trainingImages.Add(TrainedFace);
                labels.Add(maskedTextBox1.Text);

                //Show face added in gray scale
                imageBox1.Image = TrainedFace;


                var user = _userService.GetUserDetailsByUserNumber(maskedTextBox1.Text);
                if(user != null || user.username != null)
                {
                    File.WriteAllText(Application.StartupPath + "/TrainedFaces/TrainedLabels.txt", trainingImages.ToArray().Length.ToString() + "%");

                    //Write the labels of triained faces in a file text for further load
                    for (int i = 1; i < trainingImages.ToArray().Length + 1; i++)
                    {

                        ImgLoc = Application.StartupPath + "/TrainedFaces/face" + i + ".bmp";
                        trainingImages.ToArray()[i - 1].Save(ImgLoc);
                        File.AppendAllText(Application.StartupPath + "/TrainedFaces/TrainedLabels.txt", labels.ToArray()[i - 1] + "%");

                        pictureBox1.ImageLocation = ImgLoc;
                        fileNameimg = i;

                    }
                }


                MessageBox.Show(maskedTextBox1.Text + "´s face detected and added :)", "Training OK", MessageBoxButtons.OK, MessageBoxIcon.Information);

                MemoryStream ms = new MemoryStream();
                pictureBox1.Image.Save(ms, ImageFormat.Png);
                byte[] pic_arr = new byte[ms.Length];
                ms.Position = 0;
                ms.Read(pic_arr, 0, pic_arr.Length);


                //connect();
                //cmd = new MySqlCommand("UPDATE tbl_users SET trackFace='" + pic_arr + "', TrainedFaces='" + fileNameimg + "' WHERE userNo='" + maskedTextBox1.Text + "'", con);
                //cmd.ExecuteNonQuery();
                //cmd.Dispose();

                _userService.UpsertUserFaceRecords(maskedTextBox1.Text, pic_arr.ToString(), fileNameimg.ToString());

                this.Close();
            }
            catch
            {
                MessageBox.Show("Enable the face detection first", "Training Fail", MessageBoxButtons.OK, MessageBoxIcon.Exclamation);
            }
        }

        private void linkLabel1_LinkClicked(object sender, LinkLabelLinkClickedEventArgs e)
        {
             this.Hide();
            FaceDetect  d = new FaceDetect();
            d.ShowDialog ();
        
        }

        private void maskTextBox1_Leave(object sender, EventArgs e)
        {
            if (string.IsNullOrWhiteSpace(txtname.Text))
            {
                maskedTextBox1.Text = "Enter your username here...";
                maskedTextBox1.ForeColor = Color.Gray;
            }
        }
    
        private void maskedTextBox1_TextChanged(object sender, EventArgs e)
        {
            
            maskedTextBox1.ForeColor = Color.Black;

            var user = _userService.GetUserDetailsByUserNumber(maskedTextBox1.Text);
            if ((user != null || user.username != null) && !String.IsNullOrEmpty(user.fName)
                || !String.IsNullOrEmpty(user.lName))

            {
                txtname.Text = String.Concat(user.lName + ", " + user.fName);
            }

            else
            {
                txtname.Text = "NO INFORMATION";
            }
        }

    }
}
