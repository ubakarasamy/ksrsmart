<template>
    <div class="home-page">
        <!-- OVERVIEW -->
<div class="panel panel-headline">
						<div class="panel-heading">
							<h3 class="panel-title">Today Overview</h3>
							<p class="panel-subtitle">Period: Sep 03, 2018</p>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="lnr lnr-users"></i></span>
										<p>
											<span class="number">1,252</span>
											<span class="title">Students</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="lnr lnr-user"></i></span>
										<p>
											<span class="number">203</span>
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
export default {
    data(){
        return {

        }
    },
	 props:['authenticateduser'],
    mounted(){

    },

    methods:{
        
    }
}
</script>

