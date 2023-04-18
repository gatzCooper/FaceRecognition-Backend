namespace FaceRecognition
{
    partial class RegisterFace
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.Panel3 = new System.Windows.Forms.Panel();
            this.LabelX1 = new DevComponents.DotNetBar.LabelX();
            this.txtname = new System.Windows.Forms.TextBox();
            this.btnFaceAdd = new System.Windows.Forms.Button();
            this.imageBox1 = new Emgu.CV.UI.ImageBox();
            this.imageBoxFrameGrabber = new Emgu.CV.UI.ImageBox();
            this.groupPanel1 = new DevComponents.DotNetBar.Controls.GroupPanel();
            this.maskedTextBox1 = new System.Windows.Forms.MaskedTextBox();
            this.pictureBox1 = new System.Windows.Forms.PictureBox();
            this.Panel3.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)(this.imageBox1)).BeginInit();
            ((System.ComponentModel.ISupportInitialize)(this.imageBoxFrameGrabber)).BeginInit();
            this.groupPanel1.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)(this.pictureBox1)).BeginInit();
            this.SuspendLayout();
            // 
            // Panel3
            // 
            this.Panel3.Controls.Add(this.LabelX1);
            this.Panel3.Dock = System.Windows.Forms.DockStyle.Top;
            this.Panel3.Location = new System.Drawing.Point(0, 0);
            this.Panel3.Name = "Panel3";
            this.Panel3.Size = new System.Drawing.Size(758, 72);
            this.Panel3.TabIndex = 1119;
            // 
            // LabelX1
            // 
            this.LabelX1.BackColor = System.Drawing.Color.Transparent;
            // 
            // 
            // 
            this.LabelX1.BackgroundStyle.BackColor = System.Drawing.Color.White;
            this.LabelX1.BackgroundStyle.BackColor2 = System.Drawing.Color.WhiteSmoke;
            this.LabelX1.BackgroundStyle.BackColorGradientAngle = 90;
            this.LabelX1.BackgroundStyle.BorderBottom = DevComponents.DotNetBar.eStyleBorderType.Solid;
            this.LabelX1.BackgroundStyle.BorderBottomWidth = 3;
            this.LabelX1.BackgroundStyle.BorderColor = System.Drawing.Color.Maroon;
            this.LabelX1.BackgroundStyle.BorderLeft = DevComponents.DotNetBar.eStyleBorderType.Solid;
            this.LabelX1.BackgroundStyle.BorderLeftWidth = 3;
            this.LabelX1.BackgroundStyle.BorderRight = DevComponents.DotNetBar.eStyleBorderType.Solid;
            this.LabelX1.BackgroundStyle.BorderRightWidth = 3;
            this.LabelX1.BackgroundStyle.BorderTop = DevComponents.DotNetBar.eStyleBorderType.Solid;
            this.LabelX1.BackgroundStyle.BorderTopWidth = 3;
            this.LabelX1.BackgroundStyle.Class = "";
            this.LabelX1.BackgroundStyle.CornerType = DevComponents.DotNetBar.eCornerType.Square;
            this.LabelX1.BackgroundStyle.TextAlignment = DevComponents.DotNetBar.eStyleTextAlignment.Center;
            this.LabelX1.Dock = System.Windows.Forms.DockStyle.Top;
            this.LabelX1.Font = new System.Drawing.Font("Cooper Black", 26.25F);
            this.LabelX1.Location = new System.Drawing.Point(0, 0);
            this.LabelX1.Name = "LabelX1";
            this.LabelX1.Size = new System.Drawing.Size(758, 70);
            this.LabelX1.Style = DevComponents.DotNetBar.eDotNetBarStyle.StyleManagerControlled;
            this.LabelX1.TabIndex = 1119;
            this.LabelX1.Text = "REGISTER FACE";
            this.LabelX1.TextAlignment = System.Drawing.StringAlignment.Center;
            // 
            // txtname
            // 
            this.txtname.BackColor = System.Drawing.SystemColors.Info;
            this.txtname.Enabled = false;
            this.txtname.Font = new System.Drawing.Font("Microsoft Sans Serif", 15F, System.Drawing.FontStyle.Regular, System.Drawing.GraphicsUnit.Point, ((byte)(0)));
            this.txtname.ForeColor = System.Drawing.Color.Blue;
            this.txtname.Location = new System.Drawing.Point(206, 498);
            this.txtname.Name = "txtname";
            this.txtname.Size = new System.Drawing.Size(350, 30);
            this.txtname.TabIndex = 1117;
            this.txtname.TextAlign = System.Windows.Forms.HorizontalAlignment.Center;
            // 
            // btnFaceAdd
            // 
            this.btnFaceAdd.FlatStyle = System.Windows.Forms.FlatStyle.System;
            this.btnFaceAdd.Font = new System.Drawing.Font("Berlin Sans FB", 18F);
            this.btnFaceAdd.Location = new System.Drawing.Point(206, 533);
            this.btnFaceAdd.Name = "btnFaceAdd";
            this.btnFaceAdd.Size = new System.Drawing.Size(350, 53);
            this.btnFaceAdd.TabIndex = 3;
            this.btnFaceAdd.Text = "Save Face";
            this.btnFaceAdd.UseVisualStyleBackColor = true;
            this.btnFaceAdd.Click += new System.EventHandler(this.btnFaceAdd_Click);
            // 
            // imageBox1
            // 
            this.imageBox1.Anchor = System.Windows.Forms.AnchorStyles.None;
            this.imageBox1.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle;
            this.imageBox1.Location = new System.Drawing.Point(390, 85);
            this.imageBox1.Name = "imageBox1";
            this.imageBox1.Size = new System.Drawing.Size(350, 350);
            this.imageBox1.SizeMode = System.Windows.Forms.PictureBoxSizeMode.StretchImage;
            this.imageBox1.TabIndex = 5;
            this.imageBox1.TabStop = false;
            // 
            // imageBoxFrameGrabber
            // 
            this.imageBoxFrameGrabber.Anchor = System.Windows.Forms.AnchorStyles.None;
            this.imageBoxFrameGrabber.BorderStyle = System.Windows.Forms.BorderStyle.FixedSingle;
            this.imageBoxFrameGrabber.Location = new System.Drawing.Point(20, 85);
            this.imageBoxFrameGrabber.Name = "imageBoxFrameGrabber";
            this.imageBoxFrameGrabber.Size = new System.Drawing.Size(350, 350);
            this.imageBoxFrameGrabber.SizeMode = System.Windows.Forms.PictureBoxSizeMode.StretchImage;
            this.imageBoxFrameGrabber.TabIndex = 4;
            this.imageBoxFrameGrabber.TabStop = false;
            // 
            // groupPanel1
            // 
            this.groupPanel1.Anchor = System.Windows.Forms.AnchorStyles.None;
            this.groupPanel1.CanvasColor = System.Drawing.SystemColors.Control;
            this.groupPanel1.ColorSchemeStyle = DevComponents.DotNetBar.eDotNetBarStyle.OfficeXP;
            this.groupPanel1.Controls.Add(this.imageBoxFrameGrabber);
            this.groupPanel1.Controls.Add(this.imageBox1);
            this.groupPanel1.Controls.Add(this.btnFaceAdd);
            this.groupPanel1.Controls.Add(this.txtname);
            this.groupPanel1.Location = new System.Drawing.Point(-3, 0);
            this.groupPanel1.Name = "groupPanel1";
            this.groupPanel1.Size = new System.Drawing.Size(761, 601);
            // 
            // 
            // 
            this.groupPanel1.Style.BackColor2SchemePart = DevComponents.DotNetBar.eColorSchemePart.PanelBackground2;
            this.groupPanel1.Style.BackColorGradientAngle = 90;
            this.groupPanel1.Style.BackColorSchemePart = DevComponents.DotNetBar.eColorSchemePart.PanelBackground;
            this.groupPanel1.Style.BorderBottom = DevComponents.DotNetBar.eStyleBorderType.Solid;
            this.groupPanel1.Style.BorderBottomWidth = 1;
            this.groupPanel1.Style.BorderColorSchemePart = DevComponents.DotNetBar.eColorSchemePart.PanelBorder;
            this.groupPanel1.Style.BorderLeft = DevComponents.DotNetBar.eStyleBorderType.Solid;
            this.groupPanel1.Style.BorderLeftWidth = 1;
            this.groupPanel1.Style.BorderRight = DevComponents.DotNetBar.eStyleBorderType.Solid;
            this.groupPanel1.Style.BorderRightWidth = 1;
            this.groupPanel1.Style.BorderTop = DevComponents.DotNetBar.eStyleBorderType.Solid;
            this.groupPanel1.Style.BorderTopWidth = 1;
            this.groupPanel1.Style.Class = "";
            this.groupPanel1.Style.CornerDiameter = 4;
            this.groupPanel1.Style.CornerType = DevComponents.DotNetBar.eCornerType.Rounded;
            this.groupPanel1.Style.TextAlignment = DevComponents.DotNetBar.eStyleTextAlignment.Center;
            this.groupPanel1.Style.TextColorSchemePart = DevComponents.DotNetBar.eColorSchemePart.PanelText;
            this.groupPanel1.Style.TextLineAlignment = DevComponents.DotNetBar.eStyleTextAlignment.Near;
            // 
            // 
            // 
            this.groupPanel1.StyleMouseDown.Class = "";
            this.groupPanel1.StyleMouseDown.CornerType = DevComponents.DotNetBar.eCornerType.Square;
            // 
            // 
            // 
            this.groupPanel1.StyleMouseOver.Class = "";
            this.groupPanel1.StyleMouseOver.CornerType = DevComponents.DotNetBar.eCornerType.Square;
            this.groupPanel1.TabIndex = 1121;
            // 
            // maskedTextBox1
            // 
            this.maskedTextBox1.Anchor = System.Windows.Forms.AnchorStyles.None;
            this.maskedTextBox1.Font = new System.Drawing.Font("Microsoft Sans Serif", 15F);
            this.maskedTextBox1.Location = new System.Drawing.Point(206, 465);
            this.maskedTextBox1.Name = "maskedTextBox1";
            this.maskedTextBox1.Size = new System.Drawing.Size(350, 30);
            this.maskedTextBox1.TabIndex = 1120;
            this.maskedTextBox1.TextAlign = System.Windows.Forms.HorizontalAlignment.Center;
            this.maskedTextBox1.TextChanged += new System.EventHandler(this.maskedTextBox1_TextChanged);
            // 
            // pictureBox1
            // 
            this.pictureBox1.Anchor = System.Windows.Forms.AnchorStyles.None;
            this.pictureBox1.Location = new System.Drawing.Point(617, 440);
            this.pictureBox1.Name = "pictureBox1";
            this.pictureBox1.Size = new System.Drawing.Size(124, 102);
            this.pictureBox1.SizeMode = System.Windows.Forms.PictureBoxSizeMode.StretchImage;
            this.pictureBox1.TabIndex = 1122;
            this.pictureBox1.TabStop = false;
            // 
            // RegisterFace
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(758, 601);
            this.Controls.Add(this.pictureBox1);
            this.Controls.Add(this.maskedTextBox1);
            this.Controls.Add(this.Panel3);
            this.Controls.Add(this.groupPanel1);
            this.Name = "RegisterFace";
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
            this.Text = "RegisterFace";
            this.WindowState = System.Windows.Forms.FormWindowState.Maximized;
            this.Load += new System.EventHandler(this.RegisterFace_Load);
            this.Panel3.ResumeLayout(false);
            ((System.ComponentModel.ISupportInitialize)(this.imageBox1)).EndInit();
            ((System.ComponentModel.ISupportInitialize)(this.imageBoxFrameGrabber)).EndInit();
            this.groupPanel1.ResumeLayout(false);
            this.groupPanel1.PerformLayout();
            ((System.ComponentModel.ISupportInitialize)(this.pictureBox1)).EndInit();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        internal System.Windows.Forms.Panel Panel3;
        private DevComponents.DotNetBar.LabelX LabelX1;
        private System.Windows.Forms.TextBox txtname;
        private System.Windows.Forms.Button btnFaceAdd;
        private Emgu.CV.UI.ImageBox imageBox1;
        private Emgu.CV.UI.ImageBox imageBoxFrameGrabber;
        private DevComponents.DotNetBar.Controls.GroupPanel groupPanel1;
        private System.Windows.Forms.MaskedTextBox maskedTextBox1;
        private System.Windows.Forms.PictureBox pictureBox1;

    }
}