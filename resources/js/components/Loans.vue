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
                <table class="table">
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th class="text-right">Loan Amount</th>
                            <th class="text-right">Loan Duration</th>
                            <th class="text-right">Bank File</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="loan in loans" :key="loan.id">
                            <td>{{loan.customer.name}}</td>
                            <td class="text-right">{{loan.pretty_amount}} LKR</td>
                            <td class="text-right">{{loan.duration}} Months</td>
                            <td class="text-right"><a :href="'/loans/download/'+loan.id">Download</a></td>
                        </tr>
                    </tbody>
                </table>
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
                loans : []
            }
        },
        mounted() {
            this.getLoans();
        },
        methods : {
            getLoans : function (){
                axios.post('/loans/fetch').then(response => {
                    this.loans = response.data.data.loans.data;
                    console.log(this.loans)
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
