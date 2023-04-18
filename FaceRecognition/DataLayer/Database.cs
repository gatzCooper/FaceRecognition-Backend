using MySql.Data.MySqlClient;
using System;
using System.Data;
using MySql.Data;

namespace FaceRecognition.DataLayer
{
    class Database
    {
        private MySqlConnection connection;
        private MySqlCommand command;
        private MySqlDataAdapter adapter;

        private string server = "localhost";
        private string username = "root";
        private string password = "";
        private string database = "faceattendancedb";

        private string connectionString;

        public Database()
        {
            connection = new MySqlConnection();
            command = new MySqlCommand();
            adapter = new MySqlDataAdapter();

            connectionString = String.Format(
                "server={0}; username={1}; password={2}; database={3}",
                server, username, password, database
                );

            connection.ConnectionString = connectionString;
        }

        protected bool ExecuteNonQuery(string sql)
        {
            using (connection)
            {
                connection.Open();

                using (command)
                {
                    command.Connection = connection;
                    command.CommandText = sql;

                    return command.ExecuteNonQuery() > 0;
                }
            }
        }

        protected DataTable ExecuteDataTable(string sql)
        {
            DataTable data = new DataTable(); 

            using (connection)
            {
                connection.Open();

                using (command)
                {
                    command.Connection = connection;
                    command.CommandText = sql;

                    using (adapter)
                    {
                        adapter.SelectCommand = command;
                        adapter.Fill(data);
                    }
                }
            }

            return data;
        }
    }
}
