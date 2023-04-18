using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;

namespace FaceRecognition.DataLayer
{
    class DL_TimeRegistration : Database
    {
        public bool ClockIn(TimeSpan time)
        {
            var sql = String.Format(
                "INSERT INTO tbl_attendances (user_id, date, clock_in)" +
                "VALUES ('{0}', CURRENT_DATE(), '{1}')",
                Properties.Settings.Default.userId, time
                );

            return ExecuteNonQuery(sql);
        }

        public bool LunchStart(int id, TimeSpan time)
        {
            var sql = String.Format(
                "UPDATE tbl_attendances " +
                "SET lunch_start='{0}'" +
                "WHERE id={1}",
                time, id
                );

            if (!ExecuteNonQuery(sql))
                return false;

            return ComputeMorningTime(Properties.Settings.Default.attendanceId);
        }

        public bool LunchEnd(int id, TimeSpan time)
        {
            var sql = String.Format(
                "UPDATE tbl_attendances " +
                "SET lunch_end='{0}'" +
                "WHERE id={1}",
                time, id
                );

            return ExecuteNonQuery(sql);
        }

        public bool ClockOut(int id, TimeSpan time)
        {

            var sql = $"UPDATE tbl_attendances set clock_out='{time}' " +
                $"where id = {id}";

            if (!ExecuteNonQuery(sql))
                return false;

            return ComputeTotalHours(Properties.Settings.Default.attendanceId);
        }

        public bool ComputeMorningTime(int id)
        {
            var sql = String.Format(
                "UPDATE tbl_attendances " +
                "SET total_hours=(" +
                "SELECT TIMEDIFF(lunch_start, clock_in) " +
                "WHERE id={0}" +
                ")" +
                "WHERE id={0}", id);

            return ExecuteNonQuery(sql);
        }

        public bool ComputeTotalHours(int id)
        {
           
            var sql = $"UPDATE tbl_attendances SET total_hours = TIMEDIFF(clock_out, clock_in)" +
                $"where id ={id}";

            return ExecuteNonQuery(sql);
        }

        public int GetAttendanceId(int userId)
        {
            var sql = String.Format(
                "SELECT * " +
                "FROM tbl_attendances " +
                "WHERE date=CURRENT_DATE() " +
                "AND user_id='{0}' " +
                "ORDER BY id DESC " +
                "LIMIT 1",
                 Properties.Settings.Default.userId
                );

            var result = ExecuteDataTable(sql);

            return (result != null && result.Rows.Count > 0) ? (int)result.Rows[0]["id"] : 0;
        }

        public DataTable GetAttendanceById(int id)
        {
            DateTime dateTime = DateTime.UtcNow.Date;
            DateTime today = DateTime.Today;

            var sql = "SELECT * " +
                "FROM tbl_attendances " +
                "WHERE id = '" + id + "' AND date = '" + today.ToString("yyyy-MM-dd") + "'  "; //DateTime.Now.TimeOfDay  // 

            return ExecuteDataTable(sql);
        }

        public bool IsTotalHoursLessThanOneHour(int id)
        {
            var sql = $"select HOUR(TIMEDIFF(NOW(), MAX(CAST(clock_in as DATETIME)))) AS total_hours " +
                $"from tbl_attendances where id = {id}";

            var result = ExecuteDataTable(sql);
            return (int)result.Rows[0]["total_hours"] < 1;
        }

        public DataTable GetTimeSheetByUserId()
        {
            var sql = "SELECT " +
                "DATE_FORMAT(date, '%M %d, %Y') AS 'DATE', " +
                " CONCAT(fname, ' ',lname) AS 'FULLNAME', " +
                "TIME_FORMAT(clock_in, '%h:%i:%s %p') AS 'TIME IN - AM', " +
                "TIME_FORMAT(lunch_start, '%h:%i:%s %p') AS 'TIME OUT - AM', " +
                "TIME_FORMAT(lunch_end, '%h:%i:%s %p') AS 'TIME IN - PM'," +
                "TIME_FORMAT(clock_out, '%h:%i:%s %p') AS 'TIME OUT - PM', " +
                "total_hours AS 'TOTAL HOURS'" +
                "FROM tbl_attendances a INNER JOIN tbl_users u ON u.id=a.user_id  WHERE user_id = '" + Properties.Settings.Default.userId + "'"; //  WHERE user_id = '" + userId + "'

            return ExecuteDataTable(sql);
        }

        public DataTable GetTimeSheet()
        {
            var sql = "SELECT " +
                "DATE_FORMAT(date, '%M %d, %Y') AS 'DATE', " +
                " CONCAT(fname, ' ',lname) AS 'FULLNAME', " +
                "TIME_FORMAT(clock_in, '%h:%i:%s %p') AS 'TIME IN - AM', " +
                "TIME_FORMAT(lunch_start, '%h:%i:%s %p') AS 'TIME OUT - AM', " +
                "TIME_FORMAT(lunch_end, '%h:%i:%s %p') AS 'TIME IN - PM'," +
                "TIME_FORMAT(clock_out, '%h:%i:%s %p') AS 'TIME OUT - PM', " +
                "total_hours AS 'TOTAL HOURS'" +
                "FROM tbl_attendances a INNER JOIN tbl_users u ON u.id=a.user_id  "; //  WHERE user_id = '" + userId + "'

            return ExecuteDataTable(sql);
        }


    }
}
