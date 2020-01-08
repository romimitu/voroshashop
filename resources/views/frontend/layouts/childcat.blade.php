<ul class="list-unstyled">
@foreach($childs as $child)
	<li><a href="{{ url('category-product', [$child->id, make_slug($child->name)] )}}" class="cate" id="cate1"> <span class="badge pull-right"></span> {{ $child->name }} </a>
	@if(count($child->childs))
		@include('frontend.layouts.childcat',['childs' => $child->childs])
	@endif
@endforeach
</ul>