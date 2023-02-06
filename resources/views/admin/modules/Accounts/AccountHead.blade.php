@extends('admin/layouts/mainlayout')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>Account Head</h1>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div id="zones" class="row">

                @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
                @endif

                <div class="box box-default">

                    <div class="box-body">

                        <div class="row form-horizontal">
                            <div class="col-md-8">
                                <input type="hidden" id="AccountHead_id">

                                <div class="form-group">
                                    <label for="" class="control-label col-md-4">Account Head</label>
                                    <div class="col-md-8">
                                        <input id="AccountHead" required type="text" name="AccountHead" class="form-control input-sm" placeholder="Account Head">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label col-md-4">رئيس الحساب</label>
                                    <div class="col-md-8">
                                        <input id="AccountHead_Arabic" required type="text" name="AccountHead_Arabic" class="form-control input-sm" placeholder="رئيس الحساب">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="control-label col-md-4">Cell</label>
                                    <div class="col-md-8">
                                        <input id="Cell" required type="text" name="Cell" class="form-control input-sm" placeholder="Cell">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label col-md-4">Email</label>
                                    <div class="col-md-8">
                                        <input id="Email" required type="text" name="Email" class="form-control input-sm" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label col-md-4">Address</label>
                                    <div class="col-md-8">
                                        <input id="Address" type="textarea" name="Address" class="form-control input-sm">
                                        </textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="control-label col-md-4">Vat Number</label>
                                    <div class="col-md-8">
                                        <input id="VatNo" required type="text" name="VatNo" class="form-control input-sm" placeholder="Vat No.">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="" class="control-label col-md-4">VAT</label>
                                    <div class="col-md-8">
                                        <input id="Vat" required type="number" name="Vat" class="form-control input-sm" placeholder="Vat">
                                    </div>
                                </div>


                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box-header">

                                    <div class="pull-right">
                                        <button id="InsertAHBtn" onclick="insertAccountHead()" class="btn btn-default">
                                            <i class="fa fa-fw fa-save"></i> Save
                                        </button>
                                        <button onclick="showUpdated_AccountHead()" class="btn btn-default">
                                            <i class="fa fa-fw fa-eye"></i> Show
                                        </button>
                                        <button id="UpdateAHBtn" onclick="UpdateAccountHead()" class="btn btn-default">
                                            <i class="fa fa-fw fa-refresh"></i> Update
                                        </button>
                                    </div>

                                </div>

                            </div>

                        </div>
                        <!-- </form> -->

                        <div style="overflow-x:scroll">


                            <div class="modal fade" id="AccountHeadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog mw-100 w-50" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"> <b> Edit Account Head </b>

                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>

                                            </h5>

                                        </div>
                                        <div class="modal-body">
                                            <div id="here_show_table_content">

                                                <table id="account_head_table" class="table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">AccountHead</th>
                                                            <th>Vat Number</th>
                                                            <th>VAT</th>
                                                            <th scope="col">Action</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>

                                            </div>
                                            <div class="box-footer">
                                            </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>

            </div>
        </div>

    </section>

</div>


<script>
    $(".loader").hide()

    document.getElementById('UpdateAHBtn').disabled = true;
    var page_number = 1;
    variable_id_for_edit = '';
    var updated_ids_array = [];
    // data_table_pagination()

    function data_table_pagination() {
        $(function() {
            var table = $('#account_head_table').DataTable({
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

    function showUpdated_AccountHead() {
        $('#AccountHeadModal').modal('show')
        $.ajax({
            url: '/AccountHead_1',
            type: 'get',
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
                                        <td>${el.AccountHead}</td>
                                        <td>${el.VatNo}</td>
                                        <td>${el.Vat}</td>

                                        <td>
                                            <span style="cursor: pointer;" id="id_${el.id}" onclick="getValueForEdit('${el.id}',this.id)">
                                                <i class="fa fa-fw fa-edit"></i> Edit
                                            </span>

                                            <span style="cursor: pointer;" onclick="confirmToDelete('${el.id}')">
                                                <i class="fa fa-fw fa-eraser"></i> Delete
                                            </span>

                                        </td>
                                    </tr>
            
            `;

                    })

                    document.getElementById('here_show_table_content').innerHTML = '';

                    var table = `
                            <table id="account_head_table" class="table">
                                <thead>
                                <tr>
                                        <th scope="col">AccountHead</th>
                                        <th scope="col">Vat Number</th>
                                        <th scope="col">VAT</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody id="abc">


                                </tbody>
                            </table>
    `;


                    document.getElementById('here_show_table_content').innerHTML = table;

                    data_table_pagination()

                    document.getElementById('abc').innerHTML = tr;

                    for (var a = 0; a < updated_ids_array.length; a++) {
                        document.getElementById(updated_ids_array[a]).style = "color:red;cursor:pointer";
                    }

                }

            }
        })
    }


    function insertAccountHead() {

        var AccountHead = document.getElementById('AccountHead').value;
        var AccountHead_Arabic = document.getElementById('AccountHead_Arabic').value;
        var Cell = document.getElementById('Cell').value;
        var Email = document.getElementById('Email').value;
        var Address = document.getElementById('Address').value;
        var VatNo = document.getElementById('VatNo').value;
        var Vat = document.getElementById('Vat').value;
        var token = '{{csrf_token()}}';
        $.ajax({
            url: '/insertAccountHead',
            type: 'post',
            data: {
                AccountHead: AccountHead,
                AccountHead_Arabic: AccountHead_Arabic,
                Cell: Cell,
                Address: Address,
                Email: Email,
                VatNo: VatNo,
                Vat: Vat,
                _token: token

            },
            beforeSend: function() {
                $('.loader').show()
            },
            success: function(data) {
                // console.log(data)
                if (data == 'inserted') {
                    $('.loader').hide()
                    document.getElementById('AccountHead').value = '';
                    document.getElementById('AccountHead_Arabic').value = '';
                    document.getElementById('Cell').value = '';
                    document.getElementById('Email').value = '';
                    document.getElementById('Address').value = '';
                    document.getElementById('VatNo').value = '';
                    document.getElementById('Vat').value = '';

                }
            }
        })

        document.getElementById('AccountHead').focus()
        document.getElementById('AccountHead').select();
    }



    function confirmToDelete(id) {
        var status = confirm('Want to delete ?');
        if (status) {
            // location.href = value;
            $.ajax({
                url: '/AccountHeadDelete',
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
                        showUpdated_AccountHead()
                    }
                }
            })
        }

    }



    document.getElementById('updateAccountHeadError').style.display = 'none';


    function UpdateAccountHead() {

        var AccountHead = document.getElementById('AccountHead').value;
        var AccountHead_Arabic = document.getElementById('AccountHead_Arabic').value;
        var Email = document.getElementById('Email').value;
        var Cell = document.getElementById('Cell').value;
        var Address = document.getElementById('Address').value;
        var VatNo = document.getElementById('VatNo').value;
        var Vat = document.getElementById('Vat').value;

        var AccountHead_id = document.getElementById('AccountHead_id').value;
        var token = '{{csrf_token()}}';
        $.ajax({
            url: '/updateAccountHead',
            type: 'post',
            data: {
                AccountHead: AccountHead,
                AccountHead_Arabic: AccountHead_Arabic,
                Cell: Cell,
                Address: Address,
                Email: Email,
                VatNo: VatNo,
                Vat: Vat,
                id: AccountHead_id,
                _token: token

            },
            beforeSend: function() {
                $('.loader').show()
            },
            success: function(data) {
                console.log(data)
                if (data == 'updated') {
                    $('.loader').hide()
                    document.getElementById('UpdateAHBtn').disabled = true;
                    document.getElementById('InsertAHBtn').disabled = false;

                    document.getElementById('AccountHead').value = '';
                    document.getElementById('AccountHead_Arabic').value = '';
                    document.getElementById('Cell').value = '';
                    document.getElementById('Email').value = '';
                    document.getElementById('Address').value = '';
                    document.getElementById('VatNo').value = '';
                    document.getElementById('Vat').value = '';
                    updated_ids_array.push(variable_id_for_edit)

                } else {
                    $('#exampleModal').modal('hide');

                }
            }
        })
    }

    function getValueForEdit(id, id_for_edit) {
        document.getElementById('UpdateAHBtn').disabled = false;
        document.getElementById('InsertAHBtn').disabled = true;

        document.getElementById('AccountHead_id').value = id;
        variable_id_for_edit = id_for_edit;
        $('#AccountHeadModal').modal('hide')

        $.ajax({
            url: '/AccountHeadEdit',
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
                    document.getElementById('AccountHead_id').value = data.id;
                    document.getElementById('AccountHead').value = data.AccountHead;
                    document.getElementById('AccountHead_Arabic').value = data.AccountHead_Arabic;
                    document.getElementById('Cell').value = data.Cell;
                    document.getElementById('Email').value = data.Email;
                    document.getElementById('Address').value = data.Address;
                    document.getElementById('VatNo').value = data.VatNo;
                    document.getElementById('Vat').value = data.Vat;
                    $(".loader").hide();
                } else {
                    $(".loader").show();
                }
            },
            error: function(req, status, error) {
                console.log(error)

            }
        })
        $('#exampleModal').modal('show');
    }
</script>
@endsection