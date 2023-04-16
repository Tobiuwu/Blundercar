/** ----------- Event Listeners ----------- */

// Call the function when the document is ready
$(document).ready(function() {
    $("#tableDownload").prop("disabled", true);
    // Populate the month select element with the past 5 months
    populateMonthSelect("#element");
    // excel table download
    $("#tableDownload").click(function() {
        var dateTime = new Date().toISOString().replace(/T/, ' ').replace(/\..+/, ''); // Get the current date and time
        var filename = "report-" + dateTime + ".xls"; // Add the current date and time to the filename
        $("#reportTable").table2excel({
          filename: filename
        });
      });
});

/** ----------- Functions ----------- */

function populateMonthSelect(ElementId) {
    // Get the current month and year
    var currentDate = new Date();
    var currentMonth = currentDate.getMonth();
    var currentYear = currentDate.getFullYear();
  
    // Create an array of month names
    var monthNames = [
      "January", "February", "March", "April", "May", "June", "July",
      "August", "September", "October", "November", "December"
    ];
  
    // Loop through the past 5 months, starting with the current month
    for (var i = 0; i <= 5; i++) {
      // Calculate the month and year for the current iteration
      var month = currentMonth - i;
      var year = currentYear;
  
      if (month < 0) {
        // If the month is negative, subtract it from the year and add 12
        month += 12;
        year--;
      }
  
      // Create an option element and append it to the select element
      var option = $("<option>")
        .val(year + "-" + (month + 1).toString().padStart(2, "0"))
        .text(monthNames[month] + " " + year);
      $(ElementId).append(option);
    }
}

function failed_submit(id, error_message = "Failed to retrieve data from the server.") {
  // Function sets HTML for when form submit has failed
  setTimeout(function () {
    $(id).html(`
      <h3>Error!</h3>
      <h6>${error_message}</h6>
      <div class="f-modal-icon f-modal-error animate">
          <span class="f-modal-x-mark">
              <span class="f-modal-line f-modal-left animateXLeft"></span>
              <span class="f-modal-line f-modal-right animateXRight"></span>
          </span>
          <div class="f-modal-placeholder"></div>
          <div class="f-modal-fix"></div>
      </div>
      </br>
      <hr>
    `).removeClass("hidden");
  }, 700);
  
  $("#salesDataContainer").addClass("hidden");
}

/** ----------- Functions END ----------- */
  
$('#reportSubmit').click(function () {
    // Get variables from form and submit it
    var selectedMonth = $("#element option:selected").val();
    var reportDataFrame = $("#sellvehicles option:selected").val();

    // AJAX Post sending data
    $.ajax({
        url: "database/report.php",
        method: "POST",
        data: {
            Report: true,
            reportDataFrame: reportDataFrame,
            selectedMonth: selectedMonth,
        },
        success: function (result) {
            // Successful submition (Http 200), clear previous errors
            $('#result').addClass("hidden");
            $("#salesDataContainer").removeClass("hidden");
            // parse result
            htmlObject = JSON.parse(result);
            $("#tableLine").html(htmlObject.linesHTML);
            $("#sales").text(htmlObject.sales);
            $("#button").html(htmlObject.buttonHTML);
            // enable download button
            $("#tableDownload").prop("disabled", false);
            console.log(result);
        },
        error: function () {
            // Failed submition (Http 400 or Http 500)
            failed_submit('#result');
        }
    })
});

