using System;
using System.Collections.Generic;
using System.Data.SqlClient;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace FaceRecognition.DataLayer
{
    public interface IDataAccessService
    {
       int ExecuteNonQuery(string query, IEnumerable<SqlParameter> parameters = null);
       IDataReader ExecuteReader(string query, IEnumerable<SqlParameter> parameters = null);
       object ExecuteScalar(string query, IEnumerable<SqlParameter> parameters = null);

       void Dispose();
    }
}
