function togglePassword(id) {
    let input = document.getElementById(id);
    input.type = input.type === "password" ? "text" : "password";
    }

    document.getElementById("loginForm").addEventListener("submit", function (e) {
        e.preventDefault();

        let username = document.getElementById("username").value;
        let password = document.getElementById("password").value;

        let xmlData = `<login><username>${username}</username><password>${password}</password></login>`;

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "login.php", true);
        xhr.setRequestHeader("Content-Type", "application/xml");

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                let responseXML = xhr.responseXML;
                let status = responseXML.getElementsByTagName("status")[0].textContent;
                let message = responseXML.getElementsByTagName("message")[0].textContent;
            if (status === "success") {
                window.location.href = "../index.php";
            } else {
                document.getElementById("result").textContent = message;
            }
            }
        };

        xhr.send(xmlData);
    });