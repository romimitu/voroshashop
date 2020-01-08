<ul>
@foreach($childs as $child)
	<li>
	    {{ $child->name }}  <a class="tree-action" href="{{ url('/category/'.$child->id.'/edit') }}">(view)</a>
		@if(count($child->childs))
            @include('admin.categories.childs',['childs' => $child->childs])
        @endif
	</li>
@endforeach
</ul>