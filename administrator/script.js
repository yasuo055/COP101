document.addEventListener("DOMContentLoaded", loadUsers);

// Function to load users via Fetch API
async function loadUsers() {
    try {
        const response = await fetch("fetch-user.php");
        const data = await response.json();

        const tableBody = document.getElementById("userTableBody");
        tableBody.innerHTML = ""; // Clear table before appending new rows

        const fragment = document.createDocumentFragment(); // Improve performance

        data.forEach(user => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${user.USERID}</td>
                <td>${user.FNAME} ${user.MNAME || ""} ${user.LNAME}</td>
                <td>${user.USERNAME}</td>
                <td>${user.EMAIL}</td>
                <td>${user.CONTACT || "N/A"}</td>
                <td>${user.DATECREATED}</td>
                <td>${user.ROLE}</td>
                <td>
                    <button class="edit-btn" data-userid="${user.USERID}">Edit</button>
                    <button class="action-btn archive-btn" data-id="${user.USERID}">Archive</button>
                </td>
            `;
            fragment.appendChild(row);
        });

        tableBody.appendChild(fragment);
    } catch (error) {
        console.error("Error loading users:", error);
        alert("Failed to load users. Please try again later.");
    }
}

// Event Delegation for Edit Button Click
document.getElementById("userTableBody").addEventListener("click", async function(event) {
    if (event.target.classList.contains("edit-btn")) {
        const userId = event.target.dataset.userid;
        try {
            const response = await fetch(`get-user.php?userid=${userId}`);
            const user = await response.json();
            openEditModal(user);
        } catch (error) {
            console.error("Error fetching user details:", error);
            alert("Failed to fetch user details.");
        }
    }
});

// Open Edit Modal Function
function openEditModal(user) {
    document.getElementById("userid").value = user.USERID || "";
    document.getElementById("fname").value = user.FNAME || "";
    document.getElementById("mname").value = user.MNAME || "";
    document.getElementById("lname").value = user.LNAME || "";
    document.getElementById("username").value = user.USERNAME || "";
    document.getElementById("email").value = user.EMAIL || "";
    document.getElementById("contact").value = user.CONTACT || "";
    document.getElementById("role").value = user.ROLE || "";

    document.getElementById("editUserModal").style.display = "block";
}

// Close Modal when clicking the Close Button
document.querySelector(".close-btn").addEventListener("click", () => {
    document.getElementById("editUserModal").style.display = "none";
});

// Handle form submission with Fetch API
document.getElementById("editUserForm").addEventListener("submit", async function(event) {
    event.preventDefault();

    const formData = new FormData(this);
    const submitButton = this.querySelector("button[type='submit']");
    submitButton.disabled = true; // Prevent double submission

    try {
        const response = await fetch("update-user.php", {
            method: "POST",
            body: formData
        });

        const result = await response.text();
        alert(result);
        document.getElementById("editUserModal").style.display = "none";
        loadUsers(); // Refresh table after updating
    } catch (error) {
        console.error("Error updating user:", error);
        alert("Failed to update user. Please try again.");
    } finally {
        submitButton.disabled = false;
    }
});
