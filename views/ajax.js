const nestServerHost = "http://localhost:3002/controllers/studentController"
const localServerHost = "http://localhost:80/controllers/studentController.php"
const useServerHost = nestServerHost


$(document).ready(
  function () {
    setTableData();
    $("#createButton").click(function (evt) {
      evt.preventDefault();
      var dni = $("#id").val()
      var name = $("#name").val()
      var lastname = $("#lastName").val()
      var address = $("#address").val()
      var phone = $("#phoneNumber").val()

      $.ajax({
        url: `${useServerHost}`,
        type: 'POST',
        data: { dni, name, lastname, address, phone },
        success: (res) => {
          console.log(res)
          cleanInputs();
          setTableData();
        }
      })
    })

    $("#studentTable tbody").on('click', 'tr', function () {
      var id = $(this).attr("data-id");
      var dni = $(this).find('td:eq(0)').text()
      var name = $(this).find('td:eq(1)').text()
      var lastName = $(this).find('td:eq(2)').text()
      var address = $(this).find('td:eq(3)').text()
      var phoneNumber = $(this).find('td:eq(4)').text()

      $('input[name="id"]').val(dni)
      $('input[name="name"]').val(name)
      $('input[name="lastName"]').val(lastName)
      $('input[name="address"]').val(address)
      $('input[name="phoneNumber"]').val(phoneNumber)
    })

    $("#updateButton").click(function (evt){
      evt.preventDefault();
      var dni = $("#id").val()
      var name = $("#name").val()
      var lastname = $("#lastName").val()
      var address = $("#address").val()
      var phoneNumber = $("#phoneNumber").val()

      const studentData = {
        dni: dni,
        name: name,
        lastname: lastname,
        address: address,
        phone: phoneNumber
      }

      $.ajax({
        url: `${useServerHost}/${dni}`,
        data: studentData,
        type: 'PATCH',
        success: function (){
          cleanInputs();
          setTableData();
        }
      })
    })

  }
)

function setTableData() {
  $.ajax({
    url: `${useServerHost}`,
    type: 'GET',
    dataType: 'json',
    success: function (response) {
      var table = $("#studentTable tbody");
      table.empty();
      $.each(
        response, function (index, item) {
          table.append(`
          <tr data-id='${item.dni}'>
          <td class="p-3 text-sm text-gray-700">${item.dni}</td>
          <td class="p-3 text-sm text-gray-700">${item.name}</td>
          <td class="p-3 text-sm text-gray-700">${item.lastname}</td>
          <td class="p-3 text-sm text-gray-700">${item.address}</td>
          <td class="p-3 text-sm text-gray-700">${item.phone}</td>
          <td class="p-3 text-sm text-gray-700"><button onclick="deleteRow('${item.id}')" class="text-red-500 hover:text-red-700">Eliminar</button></td>
          </tr> 
          `)
        }
      )
    }
  })
}

function cleanInputs() {
  $("#id").val("");
  $("#name").val("");
  $("#lastName").val("");
  $("#address").val("");
  $("#phoneNumber").val("");
}

function deleteRow (id){
  $.ajax({
    url: `${useServerHost}/${id}`,
    type: 'DELETE',
    success: (evt) => {
      cleanInputs();
      setTableData();
    }
  })
}