<template>
    <div>
        <div id="invoice" ref="content" class="col-md-6 m-auto">
            <div class="toolbar hidden-print">
                <div class="text-right">
                    <button id="printInvoice" class="btn btn-info" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
                    <button id="ignorePDF" class="btn btn-info" @click="printWithStyle"><i class="fa fa-file-pdf-o"></i> Download as PDF</button>
                </div>
                <hr>
            </div>
            <div class="invoice overflow-auto">
                <div>
                    <main>
                        <div class="row contacts">
                            <div class="col invoice-details" >
                                <h5 class="invoice-id">Spectrum E-Library API Access Key</h5>
                                <div class="date">Company Address</div>
                                <div class="date">Contact Address</div>
                            </div>
                        </div>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tbody>
                                <tr>
                                    <td class="no text-center">KEY</td>
                                    <td class="text-left">
                                        <h3>{{key_details.key}}</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="">Valids From: </td>
                                    <td class="">{{key_details.valid_from | fullDate}}</td>
                                </tr>
                                <tr>
                                    <td class="">Expires on: </td>
                                    <td class="">{{key_details.valid_till | fullDate}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="notices">
                            <div>NOTICE:</div>
                            <div class="notice">Note: The Apikey will become inactive after <span class="text-secondary">{{key_details.valid_till | fullDate}}</span> and the API resources will become inaccessible</div>
                        </div>
                    </main>
                    <footer>
                        Please Keep the APIKEY safe
                    </footer>
                </div>
                <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                <div></div>
            </div>
        </div>
    </div>
</template>

<script>
import * as jspdf from 'jspdf';
import html2canvas from 'html2canvas';
export default {
    props: ['incoming_key'],
    data() {
        return {
            key_details: ""
        }
    },
    methods: {
        printWithStyle() {
            const page = document.getElementById('invoice');
            html2PDF(page, {
                jsPDF: {
                    unit: 'pt',
                    format: 'a4'
                },
                imageType: 'image/jpeg',
                output: 'Spectrum_Api_Key.pdf'
            });
        }
    },
    created() {
        console.log(this.incoming_key)
        axios.get('/admin/view-apiaccess-key?i='+this.incoming_key)
        .then((data)=>{
            this.key_details = data.data
        })
    }
}
</script>

<style scoped>
    .invoice {
        position: relative;
        background-color: #FFF;
        padding: 15px
    }

    .invoice header {
        padding: 10px 0;
        margin-bottom: 20px;
        border-bottom: 1px solid #3989c6
    }

    .invoice .company-details {
        text-align: right
    }

    .invoice .company-details .name {
        margin-top: 0;
        margin-bottom: 0
    }

    .invoice .contacts {
        margin-bottom: 20px
    }

    .invoice .invoice-to {
        text-align: left
    }

    .invoice .invoice-to .to {
        margin-top: 0;
        margin-bottom: 0
    }

    .invoice .invoice-details {
        text-align: right
    }

    .invoice .invoice-details .invoice-id {
        margin-top: 0;
        color: #3989c6
    }

    .invoice main {
        padding-bottom: 50px
    }

    .invoice main .thanks {
        margin-top: -100px;
        font-size: 2em;
        margin-bottom: 50px
    }

    .invoice main .notices {
        padding-left: 6px;
        border-left: 6px solid #3989c6
    }

    .invoice main .notices .notice {
        font-size: 1.2em
    }

    .invoice table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 20px
    }

    .invoice table td,.invoice table th {
        padding: 15px;
        background: #eee;
        border-bottom: 1px solid #fff
    }

    .invoice table th {
        white-space: nowrap;
        font-weight: 400;
        font-size: 16px
    }

    .invoice table td h3 {
        margin: 0;
        font-weight: 400;
        color: #3989c6;
        font-size: 1.2em
    }

    .invoice table .qty,.invoice table .total,.invoice table .unit {
        text-align: right;
        font-size: 1.2em
    }

    .invoice table .no {
        color: #fff;
        font-size: 1.6em;
        background: #3989c6
    }

    .invoice table .unit {
        background: #ddd
    }

    .invoice table .total {
        background: #3989c6;
        color: #fff
    }

    .invoice table tbody tr:last-child td {
        border: none
    }

    .invoice table tfoot td {
        background: 0 0;
        border-bottom: none;
        white-space: nowrap;
        text-align: right;
        padding: 10px 20px;
        font-size: 1.2em;
        border-top: 1px solid #aaa
    }

    .invoice table tfoot tr:first-child td {
        border-top: none
    }

    .invoice table tfoot tr:last-child td {
        color: #3989c6;
        font-size: 1.4em;
        border-top: 1px solid #3989c6
    }

    .invoice table tfoot tr td:first-child {
        border: none
    }

    .invoice footer {
        width: 100%;
        text-align: center;
        color: #777;
        border-top: 1px solid #aaa;
        padding: 8px 0
    }

    @media print {
        .invoice {
            font-size: 11px!important;
            overflow: hidden!important
        }

        .invoice footer {
            position: absolute;
            bottom: 10px;
            page-break-after: always
        }

        .invoice>div:last-child {
            page-break-before: always
        }
    }
</style>