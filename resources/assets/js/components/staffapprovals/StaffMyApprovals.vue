<template>
    <div class="home">
        <div class="panel panel-headine">
            <div class="panel-heading">
                <h3 class="panel-title">My Approvals</h3>
            </div>
        <div class="panel-body">
            <div class="my-approvals">
                <table class="table">
                <thead>
                    <th>Date</th>
                    <th>Approval For</th>
                    <th>Status</th>
                    <th>Remove</th>
                </thead>
                <tbody>
                    <tr v-for="mApproval in mApprovals" v-bind:key="mApproval.id">
                        <td>{{mApproval.date}}</td>
                        <td>{{mApproval.approval_for}}</td>
                        <td>{{mApproval.status}}</td>
                        <td>
                            <button class="btn btn-danger" @click="removeApproval(mApproval)">X</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
            <div class="create-approval">
                <h3>Create Approval</h3>
                <form @submit.prevent="createApproval()">
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="date">Date</label>
                            <input type="date" id="date" v-model="date" name="date" class="form-control" max="3000-12-1" min="2000-12-1">
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="selectedStatus">Approval for</label>
                                <select class="form-control" v-model="StatusSelected" id="selectedStatus" style="width:120px;"> 
                                    <option v-for="setStatuse in setStatuses" v-bind:value="setStatuse.value">
                                        {{ setStatuse.text }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-8">
                            <label for="description">Description</label>
                            <textarea type="text" v-model="description" id="description" name="description" class="form-control" placeholder="Description"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
</template>


<script>
export default {
    data(){
        return {
            mApprovals:[],
            
            date:'',
            StatusSelected:'',
            description:'',
            setStatuses: [
                { text: "CL", value: "cl" },
                { text: "CPL", value: "cpl" },
                { text: "OD", value: "od" },
                { text: "SOD", value: "sod" }
            ]
        }
    },

    mounted(){
        this.getmyapprovals();
    },

    props:['authenticateduser'],

    methods:{
        getmyapprovals(){
            let Formdata = {
                staff_id:this.authenticateduser.id,
            }
            fetch('/api/staff/approval/getmyapprovals', {
                    method: "post",
                    body: JSON.stringify(Formdata),
                    headers:{
                        "content-type":"application/json"
                    }
            }).then(res => {return res.json()})
            .then(data => {
                console.log(data);
                this.mApprovals = data;

            }).then(err => console.log(err));
        },
        createApproval(){
            let Formdata = {
                date:this.date,
                approval_for:this.StatusSelected,
                description:this.description,
                staff_id:this.authenticateduser.id,
            }
            fetch('/api/staff/approval/create', {
                    method: "post",
                    body: JSON.stringify(Formdata),
                    headers:{
                        "content-type":"application/json"
                    }
            }).then(res => {return res.json()})
            .then(data => {
                console.log(data);
                this.getmyapprovals();

            }).then(err => console.log(err));



        },

        removeApproval(mApproval){
            let Formdata = {
                approval_id:mApproval.id,
            }
            fetch('/api/staff/approval/removemyapprovals', {
                    method: "delete",
                    body: JSON.stringify(Formdata),
                    headers:{
                        "content-type":"application/json"
                    }
            }).then(res => {return res.json()})
            .then(data => {
                console.log(data);
                this.getmyapprovals();
                
            }).then(err => console.log(err));
        },


    }
}
</script>
