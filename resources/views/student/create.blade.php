@extends('layout.app')


@section('content')

<!-- OVERVIEW -->
<div class="panel panel-headline">
	<div class="panel-heading">
		<h3 class="panel-title">Create Student Profile</h3>

	</div>
<div class="panel-body">
	<div class="row">
        <div class="container">
            <div class="col-sm-6">
            <form action="#" method="post">
            <label for="name" class="">Name</label>
            <input type="text" class="form-control" placeholder="Name" id="name" name="name">
			<br>
            <label for="degree" class="">Degree</label>
            <select class="form-control" id="degree" name="degree">
                <option selected disabled>Choose</option>
				<option value="be">be</option>
				<option value="me">me</option>
			</select><br>
            <label for="department" class="">Department</label>
			<select class="form-control" id="department" name="department">
            <option selected disabled>Choose</option>
				<option value="ece">ece</option>
				<option value="eee">eee</option>
				<option value="cse">cse</option>
				<option value="mech">mech</option>
				<option value="automobile">automobile</option>
				<option value="civil">civil</option>
			</select>
            </form>		
            </div>
            <div class="col-sm-6">

            </div>
        </div>			
	</div>
</div>

@endsection