<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">

      <li id="Dashboard" class="{{Request::is('admin') ? 'active' : ''}}">
        <a href="/">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>



      <li id="BasicMenu" class=" treeview  
          {{Request::is('User') ? 'active' : ''}} 
          {{Request::is('AccountHead') ? 'active' : ''}}
          {{Request::is('Employee') ? 'active' : ''}}
          {{Request::is('CostCenterName') ? 'active' : ''}}
          {{Request::is('Buyers_Suppliers') ? 'active' : ''}}
          {{Request::is('Account') ? 'active' : ''}}
          {{Request::is('Role') ? 'active' : ''}}
          {{Request::is('Role_Permissions') ? 'active' : ''}}
          {{Request::is('Permissions') ? 'active' : ''}}

          {{Request::is('Account') ? 'active' : ''}}
          {{Request::is('AccountHead') ? 'active' : ''}}
          {{Request::is('Buyers') ? 'active' : ''}}
          {{Request::is('Suppliers') ? 'active' : ''}}
          {{Request::is('CostCenter') ? 'active' : ''}}

      ">
        <a href="#">
          <i class="fa fa-bars"></i> <span>Basic Menu</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">


          <li id="UserMenu" class="{{Request::is('User') ? 'active' : ''}}"><a href="/User"><i class="fa fa-industry"></i> User</a></li>

          <!-- <li id="AccountHead_Menu" class="{{Request::is('AccountHead') ? 'active' : ''}}"><a href="/AccountHead"><i class="fa fa-circle-o"></i>Account Head</a></li> -->
          <li id="Role_Menu" class="{{Request::is('Role') ? 'active' : ''}}"><a href="/Role"><i class="fa fa-circle-o"></i>Role</a></li>
          <li id="Permission_Menu" class="{{Request::is('Permission') ? 'active' : ''}}"><a href="/Permission"><i class="fa fa-circle-o"></i>Permission</a></li>
          <li id="#" class="{{Request::is('Role_Permissions') ? 'active' : ''}}"><a href="/Role_Permissions"><i class="fa fa-circle-o"></i>Role Permissions</a></li>

          <li id="AccountMenu" class="treeview {{Request::is('Account') ? 'active' : ''}}
          {{Request::is('AccountHead') ? 'active' : ''}}
          {{Request::is('Buyers') ? 'active' : ''}}
          {{Request::is('Suppliers') ? 'active' : ''}}
          {{Request::is('CostCenter') ? 'active' : ''}}
          ">
            <a href="#">
              <i class="fa fa-bars"></i> <span>Account</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li id="Bank" class="{{Request::is('Account') ? 'active' : ''}}"><a href="/Account"><i class="fa fa-circle-o"></i>Bank</a>
              <li id="AccountHead" class="{{Request::is('AccountHead') ? 'active' : ''}}"><a href="/AccountHead"><i class="fa fa-circle-o"></i>AccountHead</a>
              <li id="Buyers" class="{{Request::is('Buyers') ? 'active' : ''}}"><a href="/Buyers"><i class="fa fa-circle-o"></i>Buyers</a>
              <li id="Suppliers" class="{{Request::is('Suppliers') ? 'active' : ''}}"><a href="/Suppliers"><i class="fa fa-circle-o"></i>Suppliers</a>
              <li id="CostCenter" class="{{Request::is('CostCenter') ? 'active' : ''}}"><a href="/CostCenter"><i class="fa fa-circle-o"></i>CostCenter</a>
            </ul>
          </li>

          <li id="HR_Menu" class="treeview {{Request::is('Employee') ? 'active' : ''}}">
            <a href="#">
              <i class="fa fa-bars"></i> <span>HR</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li id="Employee" class="{{Request::is('Employee') ? 'active' : ''}}"><a href="/Employee"><i class="fa fa-circle-o"></i>Employee</a>
            </ul>
          </li>

        </ul>
      </li>



      <li id="BasicMenu" class=" treeview  
          
          {{Request::is('ExpenseType') ? 'active' : ''}}
          {{Request::is('Expense') ? 'active' : ''}}
      ">
        <a href="#">
          <i class="fa fa-bars"></i> <span>Expense Book</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">

          <li id="Expense_Menu" class="{{Request::is('Expense') ? 'active' : ''}}"><a href="/Expense"><i class="fa fa-circle-o"></i>Expense</a></li>


        </ul>
      </li>


      <li class=" treeview  
          
          {{Request::is('Cashbook') ? 'active' : ''}}
      ">
        <a href="#">
          <i class="fa fa-bars"></i> <span>Cash Book</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">

          <li id="Cashbook_Menu" class="{{Request::is('Cashbook') ? 'active' : ''}}"><a href="/Cashbook"><i class="fa fa-circle-o"></i>Cash</a></li>


        </ul>
      </li>

      <li class=" treeview  
          
          {{Request::is('Store') ? 'active' : ''}}
          {{Request::is('ItemCategory') ? 'active' : ''}}
          {{Request::is('ItemSubCategory') ? 'active' : ''}}
          {{Request::is('Dish') ? 'active' : ''}}
          {{Request::is('RawItems') ? 'active' : ''}}
      ">
        <a href="#">
          <i class="fa fa-bars"></i> <span>Store Managment</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">

          <li id="Store_Menu" class="{{Request::is('Store') ? 'active' : ''}}"><a href="/Store"><i class="fa fa-circle-o"></i>Store</a></li>
          <li id="ItemCategory_Menu" class="{{Request::is('ItemCategory') ? 'active' : ''}}"><a href="/ItemCategory"><i class="fa fa-circle-o"></i>Item Category</a></li>
          <li id="ItemSubCategory_Menu" class="{{Request::is('ItemSubCategory') ? 'active' : ''}}"><a href="/ItemSubCategory"><i class="fa fa-circle-o"></i>Item Sub Category</a></li>


          <li id="Dish_Menu" class="{{Request::is('Dish') ? 'active' : ''}}"><a href="/Dish"><i class="fa fa-circle-o"></i>Dish</a></li>
          <li id="RawItems_Menu" class="{{Request::is('RawItems') ? 'active' : ''}}"><a href="/RawItems"><i class="fa fa-circle-o"></i>RawItem</a></li>

        </ul>
      </li>


    </ul>
  </section>
  <!-- /.sidebar -->
</aside>


<script>
  show_menus_with_respect_to_roles()

  function show_menus_with_respect_to_roles() {

    var UserRole = (JSON.parse(sessionStorage.getItem('Permissions_of_selected_role')))
  
    if (((UserRole)).includes('HR Menu')) {
      document.getElementById('HR_Menu').style.display = 'block'
    } else {
      document.getElementById('HR_Menu').style.display = 'none'
      
    }
    if (((UserRole)).includes('HR Menu (Employee Tab)')) {
      document.getElementById('Employee').style.display = 'block'
    } else {
      document.getElementById('Employee').style.display = 'none'

    }

    if (((UserRole)).includes('Account Menu')) {
      document.getElementById('AccountMenu').style.display = 'block'
    } else {
      document.getElementById('AccountMenu').style.display = 'none'
    }

    if (((UserRole)).includes('User Menu (Role Tab)')) {
      document.getElementById('Role_Menu').style.display = 'block'
    } else {
      document.getElementById('Role_Menu').style.display = 'none'
    }

    if (((UserRole)).includes('Account Head')) {
      document.getElementById('AccountHead_Menu').style.display = 'block'
    } else {
      document.getElementById('AccountHead_Menu').style.display = 'none'
    }
    if (((UserRole)).includes('User Menu')) {
      document.getElementById('UserMenu').style.display = 'block'
    } else {
      document.getElementById('UserMenu').style.display = 'none'
    }
  }
</script>