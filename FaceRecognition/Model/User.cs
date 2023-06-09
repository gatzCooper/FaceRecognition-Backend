﻿using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace FaceRecognition.Model
{
    public class User
    {
        public int userId { get; set; }
        public string userNo { get; set; }
        public string employmentCode { get; set; }
        public string empDescription { get; set; }
        public string fName { get; set; }
        public string lName { get; set; }
        public string mName { get; set; }
        public string email { get; set; }
        public string contact { get; set; }
        public string address { get; set; }
        public string departmentName { get; set; }
        public string username { get; set; }
        public string password { get; set; }
        public string status { get; set; }
        public DateTime? hiredDate { get; set; }
        public DateTime? createdAt { get; set; }
    }
}
