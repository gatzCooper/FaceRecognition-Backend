using FaceRecognition.DataLayer;
using FaceRecognition.Model;
using FaceRecognition.Services;
using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace FaceRecognition
{
    public class UserService : IUserService
    {
        private const string SP_GET_USER_BY_USER_NUMBER = "usp_GetUserInfoByUserNumber";
        private const string SP_UPSERT_USER_FACE_RECORD = "usp_UpsertUserFaceRecord";
        
        public User GetUserDetailsByUserNumber(string userNumber)
        {
            IDataAccessService _dataAccessService = new DataAccessService();
            SqlParameter[] parameters = new SqlParameter[]
            {
                new SqlParameter("@userNo", userNumber)
            };

            var user = new User();

            try
            {
                using (SqlDataReader sqlDataReader = (SqlDataReader)_dataAccessService.ExecuteReader(SP_GET_USER_BY_USER_NUMBER, parameters))
                {
                    while (sqlDataReader.Read())
                    {
                        user.userId = Convert.ToInt32(sqlDataReader["userId"]);
                        user.userNo = Convert.ToString(sqlDataReader["userNumber"]) ?? "";
                        user.employmentCode = Convert.ToString(sqlDataReader["employmentCode"]) ?? "";
                        user.empDescription = Convert.ToString(sqlDataReader["empDescription"]) ?? "";
                        user.fName = Convert.ToString(sqlDataReader["firstName"]) ?? "";
                        user.lName = Convert.ToString(sqlDataReader["lastName"]) ?? "";
                        user.mName = Convert.ToString(sqlDataReader["middleName"]) ?? "";
                        user.email = Convert.ToString(sqlDataReader["emailAddress"]) ?? "";
                        user.contact = Convert.ToString(sqlDataReader["mobileNumber"]) ?? "";
                        user.address = Convert.ToString(sqlDataReader["homeAddress"]) ?? "";
                        user.departmentName = Convert.ToString(sqlDataReader["departmentName"]) ?? "";
                        user.username = Convert.ToString(sqlDataReader["userName"]) ?? "";
                        user.status = Convert.ToString(sqlDataReader["statusName"]) ?? "";
                        user.hiredDate = sqlDataReader["hiredDate"] == DBNull.Value ? (DateTime?)null : Convert.ToDateTime(sqlDataReader["hiredDate"]);
                        user.createdAt = sqlDataReader["createdAt"] == DBNull.Value ? (DateTime?)null : Convert.ToDateTime(sqlDataReader["createdAt"]);
                    }
                    return user;
                }

            }
            catch (Exception err)
            {
                throw;
            }
            finally
            {
                if (_dataAccessService != null)
                {
                    ((IDisposable)_dataAccessService).Dispose();
                }
            }


        }

        public void UpsertUserFaceRecords(string userNumber, string trackFace, string trainedFace)
        {
            IDataAccessService _dataAccessService = new DataAccessService();
            SqlParameter[] parameters = new SqlParameter[]
            {
                new SqlParameter("@userNumber", userNumber),
                new SqlParameter("@trackFace", trackFace),
                new SqlParameter("@trainedFaces", trainedFace),
            };

            _dataAccessService.ExecuteNonQuery(SP_UPSERT_USER_FACE_RECORD,parameters);
        }
    }
}
