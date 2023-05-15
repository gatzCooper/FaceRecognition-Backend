using System;
using System.Collections.Generic;
using System.Data;
using System.Data.SqlClient;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace FaceRecognition.DataLayer
{
    public class DataAccessService : IDataAccessService, IDisposable
    {

        private readonly string _connectionString;
        private readonly SqlConnection _sqlConnection;

        public DataAccessService()
        {
            _connectionString = $"Server=tcp:nc-webapp-db.database.windows.net,1433;Initial Catalog=faceattendancedb;Persist Security Info=False;" +
                $"User ID=nc_admin;Password=Lifeisgood69;MultipleActiveResultSets=False;Encrypt=True;TrustServerCertificate=False;Connection Timeout=30;";
            _sqlConnection = new SqlConnection(_connectionString);
        }


        public int ExecuteNonQuery(string query, IEnumerable<SqlParameter> parameters = null)
        {
            using (var command = new SqlCommand(query, _sqlConnection))
            {
                command.CommandType = System.Data.CommandType.StoredProcedure;
                if (parameters != null && parameters.Any())
                {
                    foreach (var param in parameters)
                    {
                        command.Parameters.Add(param);
                    }
                }

                try
                {
                    _sqlConnection.Open();
                    var result = command.ExecuteNonQuery();

                    return result;
                }
                catch (Exception ex)
                {
                    throw;
                }
            }
        }

        public IDataReader ExecuteReader(string query, IEnumerable<SqlParameter> parameters = null)
        {
            using (var command = new SqlCommand(query, _sqlConnection))
            {
                command.CommandType = System.Data.CommandType.StoredProcedure;
                if (parameters != null && parameters.Any())
                {
                    foreach (var param in parameters)
                    {
                        command.Parameters.Add(param);

                    }
                }

                try
                {
                    _sqlConnection.Open();
                    var result =  command.ExecuteReader();

                    return result;
                }
                catch (Exception ex)
                {
                    throw;
                }
            }
        }

        public object ExecuteScalar(string query, IEnumerable<SqlParameter> parameters = null)
        {
            using (var connection = new SqlConnection(_connectionString))
            using (var command = new SqlCommand(query, connection))
            {
                command.CommandType = System.Data.CommandType.StoredProcedure;
                if (parameters != null && parameters.Any())
                {
                    foreach (var param in parameters)
                    {
                        command.Parameters.Add(param);
                    }
                }

                try
                {
                    connection.Open();
                    var result = command.ExecuteScalar();
                    return result;
                }
                catch (Exception ex)
                {
                    throw;
                }
            }
        }

        public void Dispose()
        {
            _sqlConnection.Dispose();
        }
    }
}
