// old Code not working

//   document.addEventListener("DOMContentLoaded", function () {
//     const statusElements = document.querySelectorAll(".status");

//     statusElements.forEach((element) => {
//       const statusText = element.textContent.trim(); // Get the text content and trim whitespace

//       if (statusText === "Low") {
//         element.style.color = "#008844"; // Apply low status color directly
//       } else if (statusText === "Moderate") {
//         element.style.color = "#E55D2D"; // Apply moderate status color directly
//       } else if (statusText === "Critical") {
//         element.style.color = "#FF0000"; // Apply critical status color directly
//       }
//     });
//   });

function printReport() {
    window.print();
  }
  
