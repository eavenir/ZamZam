<script>
    $(".loader").hide()
    document.getElementById('UpdateSupplierBtn').disabled = true;

    var page_number = 1;
    variable_id_for_edit = '';
    var updated_ids_array = [];
    // data_table_pagination_supplier()

    function data_table_pagination_supplier() {
        $(function() {
            var table = $('#supplier_table').DataTable({
                drawCallback: function() {
                    $('.paginate_button', this.api().table().container()).on('click', function(data) {
                        // console.log(data.currentTarget.innerText);
                        page_number = data.currentTarget.innerText;
                    });
                },

            })
            table.page(page_number - 1).draw('page');
        })
    }

    function Showsuppliers() {
        $('#SuppliersModal').modal('show')
        $.ajax({
            url: '/Buyers_Suppliers_1',
            type: 'get',
            data: {
                AccountType: 'Supplier'
            },
            beforeSend: function() {
                $('.loader').show()
            },
            success: function(data) {
                console.log(data)
                if (data) {
                    $('.loader').hide()
                    var tr = ``;
                    data.forEach((el) => {

                        tr += `
                    <tr>
                                        <td>${el.AccountName}</td>
                                        <td>${el.AccountName_Arabic}</td>
                                        <td>${el.AccountType}</td>
                                        <td>${el.Balance}</td>
                                        <td>${el.Cell}</td>
                                        <td>${el.ContactPerson}</td>
                                        <td>${el.Address}</td>
                                        <td>${el.VatNo}</td>
                                        <td>${el.BankDetail}</td>

                                        <td>
                                            <span style="cursor: pointer;" id="id_${el.id}" onclick="getValueForEdit_supplier('${el.id}',this.id)">
                                                <i class="fa fa-fw fa-edit"></i> Edit
                                            </span>
                                            <br>
                                            <span style="cursor: pointer;" onclick="confirmToDelete_supplier('${el.id}')">
                                                <i class="fa fa-fw fa-eraser"></i> Delete
                                            </span>

                                        </td>
                                    </tr>
            
            `;

                    })

                    document.getElementById('here_show_table_content_supplier').innerHTML = '';

                    var table = `
                            <table id="supplier_table" class="table">
                                <thead>
                                <tr>
                                        <th scope="col">Account Name</th>
                                        <th scope="col">Account Name Arabic</th>
                                        <th scope="col">AccountType</th>
                                        <th scope="col">Balance</th>
                                        <th scope="col">Cell</th>
                                        <th scope="col">Contact Person</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">VAT No.</th>
                                        <th scope="col">Bank Detail</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody id="abc_supplier">


                                </tbody>
                            </table>
    `;


                    document.getElementById('here_show_table_content_supplier').innerHTML = table;

                    data_table_pagination_supplier()

                    document.getElementById('abc_supplier').innerHTML = tr;

                    for (var a = 0; a < updated_ids_array.length; a++) {
                        document.getElementById(updated_ids_array[a]).style = "color:red;cursor:pointer";
                    }

                }

            }
        })
    }


    function insertsupplier() {

        var AccountName = document.getElementById('AccountName_supplier').value;
        var AccountName_Arabic = document.getElementById('AccountName_Arabic_supplier').value;
        var AccountType = document.getElementById('AccountType_supplier').value;
        var Balance = document.getElementById('Balance_supplier').value;
        var Cell = document.getElementById('Cell_supplier').value;
        var ContactPerson = document.getElementById('ContactPerson_supplier').value;
        var Address = document.getElementById('Address_supplier').value;
        var VatNo = document.getElementById('VatNo_supplier').value;
        var BankDetail = document.getElementById('BankDetail_supplier').value;
        var AccountId = sessionStorage.getItem('Selected_Head');

        var token = '{{csrf_token()}}';
        $.ajax({
            url: '/insertBuyers_Suppliers',
            type: 'post',
            data: {
                AccountName: AccountName,
                AccountName_Arabic: AccountName_Arabic,
                AccountType: AccountType,
                Balance: Balance,
                Cell: Cell,
                ContactPerson: ContactPerson,
                Address: Address,
                VatNo: VatNo,
                BankDetail: BankDetail,
                AccountId: AccountId,
                _token: token

            },
            beforeSend: function() {
                $('.loader').show()
            },
            success: function(data) {
                console.log(data)
                if (data == 'inserted') {
                    $('.loader').hide()
                    document.getElementById('AccountName_supplier').value = '';
                    document.getElementById('AccountName_Arabic_supplier').value = '';
                    document.getElementById('AccountType_supplier').value = '';
                    document.getElementById('Balance_supplier').value = '';
                    document.getElementById('Cell_supplier').value = '';
                    document.getElementById('ContactPerson_supplier').value = '';
                    document.getElementById('Address_supplier').value = '';
                    document.getElementById('VatNo_supplier').value = '';
                    document.getElementById('BankDetail_supplier').value = '';
                    // showUpdated_AccountHead();


                }
            }
        })


    }



    function confirmToDelete_supplier(id) {
        var status = confirm('Want to delete ?');
        if (status) {
            // location.href = value;
            $.ajax({
                url: '/Buyers_SuppliersDelete',
                type: 'get',
                data: {
                    id: id
                },
                beforeSend: function() {
                    $('.loader').show()
                },
                success: function(data) {
                    // console.log(data)
                    if (data == 'deleted') {
                        $('.loader').hide()
                        var index = updated_ids_array.indexOf('id_' + id);
                        if (index != -1) {
                            updated_ids_array.splice(index, 1);
                        }
                        alert("AccountHead is deleted successfully !")
                        Showsuppliers()
                    }
                }
            })
        }

    }


    function Updatesupplier() {

        var AccountName = document.getElementById('AccountName_supplier').value;
        var AccountName_Arabic = document.getElementById('AccountName_Arabic_supplier').value;
        var AccountType = document.getElementById('AccountType_supplier').value;
        var Balance = document.getElementById('Balance_supplier').value;
        var Cell = document.getElementById('Cell_supplier').value;
        var ContactPerson = document.getElementById('ContactPerson_supplier').value;
        var Address = document.getElementById('Address_supplier').value;
        var VatNo = document.getElementById('VatNo_supplier').value;
        var BankDetail = document.getElementById('BankDetail_supplier').value;


        var Buyer_id = document.getElementById('supplier_id').value;
        var token = '{{csrf_token()}}';
        $.ajax({
            url: '/updateBuyers_Suppliers',
            type: 'post',
            data: {
                AccountName: AccountName,
                AccountName_Arabic: AccountName_Arabic,
                AccountType: AccountType,
                Balance: Balance,
                Cell: Cell,
                ContactPerson: ContactPerson,
                Address: Address,
                VatNo: VatNo,
                BankDetail: BankDetail,
                id: Buyer_id,
                _token: token

            },
            beforeSend: function() {
                $('.loader').show()
            },
            success: function(data) {
                console.log(data)
                if (data == 'updated') {
                    $('.loader').hide()
                    document.getElementById('UpdateSupplierBtn').disabled = true
                    document.getElementById('InsertSupplierBtn').disabled = false

                    document.getElementById('AccountName_supplier').value = '';
                    document.getElementById('AccountName_Arabic_supplier').value = '';
                    document.getElementById('AccountType_supplier').value = '';
                    document.getElementById('Balance_supplier').value = '';
                    document.getElementById('Cell_supplier').value = '';
                    document.getElementById('ContactPerson_supplier').value = '';
                    document.getElementById('Address_supplier').value = '';
                    document.getElementById('VatNo_supplier').value = '';
                    document.getElementById('BankDetail_supplier').value = '';

                    // $('#exampleModal').modal('hide');
                    updated_ids_array.push(variable_id_for_edit)
                    // showUpdated_AccountHead()

                } else {
                    $('#exampleModal').modal('hide');

                }
            }
        })
    }

    function getValueForEdit_supplier(id, id_for_edit) {
        document.getElementById('UpdateSupplierBtn').disabled = false
        document.getElementById('InsertSupplierBtn').disabled = true
        $('#SuppliersModal').modal('hide')
        // document.getElementById('AccountHead_id').value = id;
        variable_id_for_edit = id_for_edit;

        $.ajax({
            url: '/Buyers_SuppliersEdit',
            type: 'get',
            data: {
                id: id
            },
            beforeSend: function() {
                $(".loader").show();
            },

            success: function(data) {
                console.log(data)
                if (data != '') {
                    document.getElementById('supplier_id').value = data.id;
                    document.getElementById('AccountName_supplier').value = data.AccountName;
                    document.getElementById('AccountName_Arabic_supplier').value = data.AccountName_Arabic;

                    document.getElementById('AccountType_supplier').value = data.AccountType;

                    document.getElementById('Balance_supplier').value = data.Balance;
                    document.getElementById('Cell_supplier').value = data.Cell;
                    document.getElementById('ContactPerson_supplier').value = data.ContactPerson;
                    document.getElementById('Address_supplier').value = data.Address;
                    document.getElementById('VatNo_supplier').value = data.VatNo;
                    document.getElementById('BankDetail_supplier').value = data.BankDetail;
                    $(".loader").hide();
                } else {
                    $(".loader").show();
                }
            },
            error: function(req, status, error) {
                console.log(error)

            }
        })
    }
</script>