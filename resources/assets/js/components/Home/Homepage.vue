<template>
    <div class="home-page">
        <!-- OVERVIEW -->
<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Welcome</h3>
							<p class="panel-subtitle">Period: {{displayDate()}}</p>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="lnr lnr-users"></i></span>
										<p>
											<span class="number">{{Studs}}</span>
											<span class="title">Students</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="lnr lnr-user"></i></span>
										<p>
											<span class="number">{{Staffs}}</span>
											<span class="title">Staffs</span>
										</p>
									</div>
								</div>
								
							</div>
							
						</div>
					</div>
    </div>
</template>
<script>
// for date format
window.moment = require('moment');
export default {
    data(){
        return {
			Studs:'',
			Staffs:'',

        }
    },
	 props:['authenticateduser'],
    mounted(){
		this.getAllStudents();
		this.getAllStaffs();
    },

    methods:{
        displayDate(){
			return moment(Date()).format('LLLL');
		},

		 getAllStudents(){
            fetch('/api/students')
            .then(res => {
                return res.json();
            })
            .then(data => {
                this.Studs = data.length;
            }).catch(err => console.log(err));
        },
		 getAllStaffs(){
            fetch('/api/staffs')
            .then(res => {
                return res.json();
            })
            .then(data => {
                this.Staffs = data.length;
            }).catch(err => console.log(err));
        },
    }
}
</script>

