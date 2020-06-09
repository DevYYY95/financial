<div class="sidebar" data-color="blue">
  <!--
    Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
-->
  <div class="logo">
    <a href="http://www.creative-tim.com" class="simple-text logo-mini">
      {{ __('Financial') }}
    </a>
    <a href="http://www.creative-tim.com" class="simple-text logo-normal">
      {{Auth::user()->name }}
    </a>
  </div>
  <div class="sidebar-wrapper" id="sidebar-wrapper">
    <ul class="nav">
      <li class="@if ($activePage == 'home') active @endif">
        <a href="{{ route('home') }}">
          <i class="now-ui-icons design_app"></i>
          <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li class="@if ($activePage == 'expense') active @endif">
        <a href="{{ route('expense.index') }}">
          <i class="now-ui-icons business_money-coins"></i>
          <p>{{ __('Expenses') }}</p>
        </a>
      </li>
      <li class="@if ($activePage == 'income') active @endif">
        <a href="{{ route('income.index') }}">
          <i class="now-ui-icons business_money-coins"></i>
          <p>{{ __('Incomes') }}</p>
        </a>
      </li>
      <li class = "@if ($activePage == 'expense_category') active @endif">
        <a href="{{ route('expense_category.index') }}">
          <i class="now-ui-icons shopping_credit-card"></i>
          <p>{{ __('Expense Category') }}</p>
        </a>
      </li>
      <li class = " @if ($activePage == 'category') active @endif">
        <a href="{{ route('income_category.index') }}">
          <i class="now-ui-icons shopping_credit-card"></i>
          <p>{{ __('Income Category') }}</p>
        </a>
      </li>
      <li>
        <a data-toggle="collapse" href="#laravelExamples">
            <i class="now-ui-icons ui-1_settings-gear-63"></i>
          <p>
            {{ __("Setting") }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse hide" id="laravelExamples">
          <ul class="nav">
            <li class="@if ($activePage == 'profile') active @endif">
              <a href="{{ route('profile.edit') }}">
                <i class="now-ui-icons users_single-02"></i>
                <p> {{ __("User Profile") }} </p>
              </a>
            </li>
            <li class="@if ($activePage == 'users') active @endif">
              <a href="{{ route('user.index') }}">
                <i class="now-ui-icons design_bullet-list-67"></i>
                <p> {{ __("User Management") }} </p>
              </a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
</div>