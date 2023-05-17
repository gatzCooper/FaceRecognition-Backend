using FaceRecognition.Model;
using System;
using System.Collections.Generic;
using System.Data;
using System.Data.SqlClient;
using System.Linq;
using System.Text;
using static System.Windows.Forms.VisualStyles.VisualStyleElement.StartPanel;
using static System.Windows.Forms.VisualStyles.VisualStyleElement.TaskbarClock;

namespace FaceRecognition.DataLayer
{
    class DL_TimeRegistration
    {
        private const string USP_UPSERT_USER_ATTENDANCE = "usp_UpsertUserAttendance";
        private const string USP_GET_ATTENDANCEID_BY_CURRENTDATE_AND_USERID = "usp_GetAttendanceIdByUserId";
        private const string USP_GET_ATTENDANCE_BY_USERID = "usp_GetAttendanceByUserId";
        private const string USP_GET_CURRENT_ATTENDANCE_BY_ID = "usp_GetAttendanceByAttendanceId";
        private const string USP_UPDATE_CURRENT_ATTENDANCE_BY_ID = "usp_UpdateUserCurrentAttendance";
        private const string USP_GET_ALL_ATTENDANCE = "usp_GetAllAttendance";
        private const string USP_GET_TOTAL_ACTUAL_WORKING_HOURS = "usp_GetTotalWorkingHours";

        
        public bool ClockIn(TimeSpan time)
        {
            IDataAccessService _dataAccessService = new DataAccessService();

            SqlParameter[] parameters = new SqlParameter[]
            {
                new SqlParameter("@userId", Properties.Settings.Default.userId),
                new SqlParameter("@time", time)
            };

           var res  = _dataAccessService.ExecuteNonQuery(USP_UPSERT_USER_ATTENDANCE, parameters);
           return Convert.ToBoolean(res);  
            
        }

        public bool ClockOut(int id, TimeSpan time)
        {
            
            IDataAccessService _dataAccessService = new DataAccessService();
            string currentDay = DateTime.Now.DayOfWeek.ToString();
             SqlParameter[] parameters = new SqlParameter[]
            {
                new SqlParameter("@attendanceId", Properties.Settings.Default.attendanceId),
                new SqlParameter("@time", time),
                new SqlParameter("@workDay", currentDay)
            };

            var res = _dataAccessService.ExecuteNonQuery(USP_UPDATE_CURRENT_ATTENDANCE_BY_ID, parameters);
            return Convert.ToBoolean(res);
        }
        public int GetAttendanceId(int userId)
        {
            IDataAccessService dataAccessService = new DataAccessService();
   
            SqlParameter[] parameters = new SqlParameter[]
            {
                new SqlParameter("@userId", userId)
            };
            int attendanceID = 0;
            using(SqlDataReader sqlDataReader = (SqlDataReader)dataAccessService.ExecuteReader(USP_GET_ATTENDANCEID_BY_CURRENTDATE_AND_USERID, parameters))
            {
                while (sqlDataReader.Read())
                {
                    attendanceID = Convert.ToInt32(sqlDataReader["attendanceId"]);
                }
                return attendanceID;
            }
        }

        public DataTable GetCurrentDayAttendanceById(int id)
        {
            IDataAccessService dataAccessService = new DataAccessService();

            SqlParameter[] parameters = new SqlParameter[]
            {
                new SqlParameter("@attendanceId", id)
            };

            return dataAccessService.ExecuteDataTable(USP_GET_CURRENT_ATTENDANCE_BY_ID, parameters);
        }

        public bool IsTotalHoursLessThanOneHour(int id)
        {
            IDataAccessService dataAccessService = new DataAccessService();

            SqlParameter[] parameters = new SqlParameter[]
            {
                new SqlParameter("@attendanceId", id)
            };

            var result = dataAccessService.ExecuteDataTable(USP_GET_TOTAL_ACTUAL_WORKING_HOURS, parameters);
            return (int)result.Rows[0]["totalWorkingHours"] < 1;
        }

        public DataTable GetTimeSheetByUserId(int userId)
        {
            userId = Properties.Settings.Default.userId;
            SqlParameter[] parameters = new SqlParameter[]
            {
                new SqlParameter("@attendanceId", userId)
            };
            IDataAccessService dataAccessService = new DataAccessService();
            
            return dataAccessService.ExecuteDataTable(USP_GET_ATTENDANCE_BY_USERID, parameters);
        }

        public DataTable GetTimeSheet()
        {
            IDataAccessService dataAccessService = new DataAccessService();

            return dataAccessService.ExecuteDataTable(USP_GET_ALL_ATTENDANCE);
        }


    }
}
