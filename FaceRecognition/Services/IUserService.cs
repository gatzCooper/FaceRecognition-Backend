using FaceRecognition.Model;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace FaceRecognition.Services
{
    interface  IUserService
    {
        User GetUserDetailsByUserNumber(string userNumber);
        void UpsertUserFaceRecords(string userNumber, string trackFace, string trainedFace);
    }
}
