<template>
    <div class="container loans">
        <div class="row">
            <div class="col-lg-12 heading">
                <h4>Loans</h4>
                <p>Loans list at the moment.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <button class="btn btn-primary mb-1 float-right" data-toggle="modal" data-target="#addLoan">Add Loan</button>
                <div class="data-showcase">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Loan Number</th>
                                <th>Customer Name</th>
                                <th class="text-right">Loan Amount</th>
                                <th class="text-right">Loan Duration</th>
                                <th class="text-right">Bank File</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-if="loading">
                                <td colspan="5" class="text-center">Loading...</td>
                            </tr>
                            <tr v-for="loan in loans.data" :key="loan.id">
                                <td>LOAN0{{loan.id}}</td>
                                <td>{{loan.customer.name}}</td>
                                <td class="text-right">{{loan.pretty_amount}} LKR</td>
                                <td class="text-right">{{loan.duration}} Months</td>
                                <td class="text-right"><a :href="'/loans/download/'+loan.id">Download</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <pagination class="float-right" :data="loans" @pagination-change-page="getLoans"></pagination>
            </div>
        </div>
        <AddLoan v-on:loanAdded="getLoans()"/>
    </div>
</template>

<script>
    import AddLoan from './Modals/addLoan.vue';
    export default {
        components : {
            AddLoan
        },
        data(){
            return {
                loans : {},
                loading : true
            }
        },
        mounted() {
            this.getLoans();
        },
        methods : {
            getLoans : function (page = 1){
                this.loading = true;
                axios.post('/loans/fetch?page=' + page).then(response => {
                    this.loans = response.data.data.loans;
                    this.loading = false;
                }).catch(function (){
                    alert('error');
                });
            },
            addLoan : function(){
                this.addLoanModal.show = true;
            }
        }
    }
</script>
