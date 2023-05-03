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

        private string server = "nc-webapp-db.mysql.database.azure.com";
        private string username = "nc_admin";
        private string password = "P@ssword01";
        private string database = "faceattendancedb";

        private string connectionString;

        public Database()
        {
            connection = new MySqlConnection();
            command = new MySqlCommand();
            adapter = new MySqlDataAdapter();

            connectionString = $"Server={server};Port=3306;UserID={username};Password={password};Database={database};SslMode=None;";

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
