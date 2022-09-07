$(() => {
  // ================================================================
  // =====================  ADD NEW BUTTON  =========================
  // ================================================================
  $(".add-new").click(function () {
    $(this).attr("disabled", "disabled");

    // retrieve last id of the table then increment it by 1
    let lastId = $(".table tr:last-child td:first-child").text();
    let newId = parseInt(lastId) + 1;

    $("tbody").append(`
                <tr>
                    <td class='whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6'>${
                      newId ? newId : "#"
                    }</td>
                    <td><input type="date" name="date" class="form-control form-control-sm" /></td>
                    <td><input type="time" name="AM_IN" class="form-control form-control-sm" /></td>
                    <td><input type="time" name="AM_OUT" class="form-control form-control-sm" /></td>
                    <td><input type="time" name="PM_IN" class="form-control form-control-sm" /></td>
                    <td><input type="time" name="PM_OUT" class="form-control form-control-sm" /></td>
                    <td class='whitespace-nowrap px-3 py-4 text-sm text-gray-500'>00:00</td>
                    <td class='relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6'>
                        <button type="button" class="text-green-500 hover:text-green-700 mx-2 add">Add</button> 
                        <button type="button" class="text-red-500 hover:text-red-700 mx-2 remove">Delete</button>
                    </td>
                </tr>
            `);
  });

  // ================================================================
  // =======================  EDIT BUTTON  ==========================
  // ================================================================
  $(document).on("click", ".edit", function () {
    $(this).parents("tr").find("td:nth-child(2)").html(`
                <input type="date" name="date" class="form-control form-control-sm" value="${$(
                  this
                )
                  .parents("tr")
                  .find("td:nth-child(2)")
                  .text()}" />
            `);

    $(this).parents("tr").find("td:nth-child(3)").html(`
                <input type="time" name="AM_IN" class="form-control form-control-sm" value="${$(
                  this
                )
                  .parents("tr")
                  .find("td:nth-child(3)")
                  .text()}" />
            `);

    $(this).parents("tr").find("td:nth-child(4)").html(`
                <input type="time" name="AM_OUT" class="form-control form-control-sm" value="${$(
                  this
                )
                  .parents("tr")
                  .find("td:nth-child(4)")
                  .text()}" />
            `);

    $(this).parents("tr").find("td:nth-child(5)").html(`
                <input type="time" name="PM_IN" class="form-control form-control-sm" value="${$(
                  this
                )
                  .parents("tr")
                  .find("td:nth-child(5)")
                  .text()}" />
            `);

    $(this).parents("tr").find("td:nth-child(6)").html(`
                <input type="time" name="PM_OUT" class="form-control form-control-sm" value="${$(
                  this
                )
                  .parents("tr")
                  .find("td:nth-child(6)")
                  .text()}" />
            `);

    $(this).parents("tr").find("td:last-child").html(`
                <button class='text-green-500 hover:text-green-700 mx-2 save' data-id='${$(
                  this
                ).data("id")}'>Save</button>
                <button class='text-red-500 hover:text-red-700 mx-2 cancel' data-id='${$(
                  this
                ).data("id")}'>Cancel</button>
            `);
  });

  // ================================================================
  // ======================  REMOVE BUTTON  =========================
  // ================================================================
  $(document).on("click", ".remove", function () {
    $(".add-new").removeAttr("disabled");

    $(this).parents("tr").remove();
  });

  // ================================================================
  // ======================  CANCEL BUTTON  =========================
  // ================================================================
  $(document).on("click", ".cancel", function () {
    $(this)
      .parents("tr")
      .find("td:not(:last-child)")
      .each(function () {
        $(this).text($(this).find("input").val());
      });

    $(this).parents("tr").find("td:last-child").html(`
                <button class='text-yellow-500 hover:text-yellow-700 mx-2 edit' data-id='${$(
                  this
                ).data("id")}'>Edit</button>
                <button class='text-red-500 hover:text-red-700 mx-2 delete' data-id='${$(
                  this
                ).data("id")}'>Delete</button>
            `);
  });

  // ================================================================
  // ========================  ADD BUTTON  ==========================
  // ================================================================
  $(document).on("click", ".add", function () {
    let date = $(this).parent().siblings().find('input[name="date"]').val();
    let AM_IN = $(this).parent().siblings().find('input[name="AM_IN"]').val();
    let AM_OUT = $(this).parent().siblings().find('input[name="AM_OUT"]').val();
    let PM_IN = $(this).parent().siblings().find('input[name="PM_IN"]').val();
    let PM_OUT = $(this).parent().siblings().find('input[name="PM_OUT"]').val();

    $.ajax({
      url: "api/addTimesheet.php",
      type: "POST",
      data: {
        date: date,
        AM_IN: AM_IN,
        AM_OUT: AM_OUT,
        PM_IN: PM_IN,
        PM_OUT: PM_OUT,
      },
      success: (data) => {
        location.reload();
      },
    });
  });

  // ================================================================
  // =======================  SAVE BUTTON  ==========================
  // ================================================================
  $(document).on("click", ".save", function () {
    let id = $(this).data("id");
    let date = $(this).parents("tr").find("td:nth-child(2) input").val();
    let AM_IN = $(this).parents("tr").find("td:nth-child(3) input").val();
    let AM_OUT = $(this).parents("tr").find("td:nth-child(4) input").val();
    let PM_IN = $(this).parents("tr").find("td:nth-child(5) input").val();
    let PM_OUT = $(this).parents("tr").find("td:nth-child(6) input").val();

    $.ajax({
      url: "api/updateTimesheet.php",
      type: "POST",
      data: {
        id: id,
        date: date,
        AM_IN: AM_IN,
        AM_OUT: AM_OUT,
        PM_IN: PM_IN,
        PM_OUT: PM_OUT,
      },
      success: (data) => {
        location.reload();
      },
    });
  });

  // ================================================================
  // ======================  DELETE BUTTON  =========================
  // ================================================================
  $(document).on("click", ".delete", function () {
    let id = $(this).data("id");

    $.ajax({
      url: "api/deleteTimesheet.php",
      type: "POST",
      data: {
        id: id,
      },
      success: (data) => {
        location.reload();
      },
    });
  });
});
