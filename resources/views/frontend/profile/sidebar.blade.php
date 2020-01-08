<div class="customer-sidebar col-xl-3 col-lg-4 mb-md-5">
  <div class="customer-profile">
      <a href="#" class="d-inline-block">
          <img src="{{$user->userdetails ? $user->userdetails->image : ''}}" class="img-fluid rounded-circle customer-image">
      </a>
      <h5>{{$user->name}}</h5>
      <p class="text-muted text-small">{{$user->userdetails ? $user->userdetails->title : ''}}</p>
  </div>
  <nav class="list-group customer-nav">
      <a href="{{route('order.list')}}" class="list-group-item d-flex justify-content-between align-items-center"><span><span class="icon icon-bag"></span>Orders</span></a>
      <a href="/user/profile" class="active list-group-item d-flex justify-content-between align-items-center"><span><span class="icon icon-profile"></span>Profile</span></a>
      <a href="{{ route('logout') }}" class="list-group-item d-flex justify-content-between align-items-center" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span><span class="fa fa-sign-out"></span>Log out</span></a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
      </form>
  </nav>
</div>