import React, { useState } from "react";

function App() {
  const [users, setUsers] = useState([]);
  const [formData, setFormData] = useState({ name: "", email: "", password: "", dob: "" });

  const fetchUsers = async () => {
    try {
      const res = await fetch("http://localhost/User-api/api.php");
      const data = await res.json();
      setUsers(data);
    } catch (err) {
      console.error("Error fetching users:", err);
    }
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      await fetch("http://localhost/User-api/api.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(formData),
      });
      setFormData({ name: "", email: "", password: "", dob: "" });
      fetchUsers();
    } catch (err) {
      console.error("Error submitting form:", err);
    }
  };

  const handleDelete = async (id) => {
    try {
      await fetch(`http://localhost/User-api/api.php?id=${id}`, {
        method: "DELETE",
      });
      fetchUsers();
    } catch (err) {
      console.error("Error deleting user:", err);
    }
  };

  return (
    <div style={containerStyle}>
      {/* Form Side */}
      <div style={formContainerStyle}>
        <h2>Add User</h2>
        <form onSubmit={handleSubmit}  style={{ 
    marginLeft: "21px", 
    marginRight: "51px" 
        }}>
          <input
            type="text"
            placeholder="Name"
            value={formData.name}
            onChange={(e) => setFormData({ ...formData, name: e.target.value })}
            required
            style={inputStyle}
          />
          <input
            type="email"
            placeholder="Email"
            value={formData.email}
            onChange={(e) => setFormData({ ...formData, email: e.target.value })}
            required
            style={inputStyle}
          />
          <input
            type="password"
            placeholder="Password"
            value={formData.password}
            onChange={(e) => setFormData({ ...formData, password: e.target.value })}
            required
            style={inputStyle}
          />
          <input
            type="date"
            value={formData.dob}
            onChange={(e) => setFormData({ ...formData, dob: e.target.value })}
            required
            style={inputStyle}
          />

          {/* Buttons side-by-side */}
          <div style={buttonGroupStyle}>
            <button type="submit" style={buttonStyle}>
              Add User
            </button>
            <button
              type="button"
              onClick={fetchUsers}
              style={{ ...buttonStyle, backgroundColor: "#007BFF" }}
            >
              Load Users
            </button>
          </div>
        </form>
      </div>

      {/* Users Table Side */}
      <div style={usersContainerStyle}>
        <h2>Users List</h2>
        <table style={tableStyle}>
          <thead>
            <tr>
              <th style={thStyle}>ID</th>
              <th style={thStyle}>Name</th>
              <th style={thStyle}>Email</th>
              <th style={thStyle}>DOB</th>
              <th style={thStyle}>Action</th>
            </tr>
          </thead>
          <tbody>
            {users.length > 0 ? (
              users.map((user) => (
                <tr key={user.id}>
                  <td style={tdStyle}>{user.id}</td>
                  <td style={tdStyle}>{user.name}</td>
                  <td style={tdStyle}>{user.email}</td>
                  <td style={tdStyle}>{user.dob}</td>
                  <td style={tdStyle}>
                    <button
                      onClick={() => handleDelete(user.id)}
                      style={{ ...buttonStyle, backgroundColor: "#dc3545" }}
                    >
                      Delete
                    </button>
                  </td>
                </tr>
              ))
            ) : (
              <tr>
                <td colSpan="5" style={{ textAlign: "center", padding: "10px" }}>
                  No Users Found
                </td>
              </tr>
            )}
          </tbody>
        </table>
      </div>
    </div>
  );
}

// ========== Styles ==========
const containerStyle = {
  display: "flex",
  padding: "30px",
  fontFamily: "Arial, sans-serif",
};

const formContainerStyle = {
  width: "30%",
  padding: "20px",
  marginLeft: "21px",
  marginRight: "51px",
  boxShadow: "0px 0px 10px rgba(0,0,0,0.1)",
  borderRadius: "10px",
};

const usersContainerStyle = {
  width: "65%",
  padding: "20px",marginLeft: "21px",
  marginRight: "51px",

};

const tableStyle = {
  width: "100%",
  borderCollapse: "collapse",
};

const inputStyle = {
  width: "100%",
  padding: "10px",
  margin: "10px 0",
  borderRadius: "5px",
  border: "1px solid #ccc",
};

const buttonStyle = {
  padding: "10px 20px",
  border: "none",
  borderRadius: "5px",
  backgroundColor: "#28a745",
  color: "white",
  cursor: "pointer",
};

const buttonGroupStyle = {
  display: "flex",
  justifyContent: "space-between",
  marginTop: "20px",
};

const thStyle = {
  padding: "12px",
  background: "#f8f8f8",
  borderBottom: "1px solid #ddd",
};

const tdStyle = {
  padding: "12px",
  borderBottom: "1px solid #ddd",
};

export default App;
