{{ auth()->user()->name }}
<br>
<br>

@can('contractor')
	Contractors can see this!
	<br>
	<br>
@endcan

@can('client')
	Clients can see this! 
@endcan
