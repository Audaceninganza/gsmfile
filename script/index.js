document.addEventListener("DOMContentLoaded", function () {
  // Show the file section when the page loads
  document.getElementById("file").style.display = "block";

  // Event listener for the home link
  document.querySelector("#li_home").addEventListener("click", function () {
    document.getElementById("file").style.display = "block";
  });

  // Function to load content dynamically using fetch (vanilla JS)
  function loadContent(url) {
    fetch(url)
      .then((response) => response.text())
      .then((data) => {
        document.getElementById("content").innerHTML = data;
      })
      .catch((error) => console.error("Error loading content:", error));
  }

  // Event listener for dynamically loading content with jQuery
  $(document).ready(function () {
    $(document).on("click", ".load-content", function (e) {
      e.preventDefault(); // Prevent default anchor behavior
      var url = $(this).data("url"); // Get the URL from data attribute

      // Load the content from the URL into the #content div
      $("#content").load(url, function (response, status, xhr) {
        if (status == "error") {
          var msg = "Sorry, there was an error: ";
          $("#content").html(msg + xhr.status + " " + xhr.statusText);
        }
      });
    });
  });

  // Search functionality for filtering models
  // function search_model() {
  //   let input = document.getElementById("search").value.toLowerCase();
  //   let items = document.querySelectorAll("#item_box");

  //   items.forEach((item) => {
  //     if (item.innerHTML.toLowerCase().includes(input)) {
  //       item.style.display = "list-item";
  //     } else {
  //       item.style.display = "none";
  //     }
  //   });
  // }

  // Attach search functionality
  document.getElementById("search").addEventListener("input", search_model);
});
