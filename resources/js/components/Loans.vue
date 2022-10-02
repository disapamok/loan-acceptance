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
                            <th>Loan Amount</th>
                            <th>Loan Duration</th>
                            <th>Bank File</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Sahan Dissanayake</td>
                            <td>250,000 LKR</td>
                            <td>12 Months</td>
                            <td><a>Download</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <AddLoan/>
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

            }
        },
        mounted() {
            this.getLoans();
        },
        methods : {
            getLoans : function (){
                axios.post('/loans/fetch').then(response => {

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
