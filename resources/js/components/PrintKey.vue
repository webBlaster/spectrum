<template>
    <div id="invoice" ref="content">
        <div class="toolbar hidden-print">
            <div class="text-right">
                <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
                <button id="ignorePDF" class="btn btn-info" @click="printWithStyle"><i class="fa fa-file-pdf-o"></i> Download as PDF</button>
            </div>
            <hr>
        </div>
        <div class="invoice overflow-auto">
            <div style="min-width: 600px">
                <main>
                    <div class="row contacts">
                        <div class="col invoice-details" v-for="seeKey in mykey" :key="seeKey.id">
                            <h1 class="invoice-id">{{seeKey.key}}</h1>
                            <div class="date">{{seeKey.valid_from}}</div>
                            <div class="date">{{seeKey.valid_till}}</div>
                        </div>
                    </div>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th class="text-left">DESCRIPTION</th>
                                <th class="text-right">HOUR PRICE</th>
                                <th class="text-right">HOURS</th>
                                <th class="text-right">TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="no">04</td>
                                <td class="text-left"><h3>
                                    <a target="_blank" href="https://www.youtube.com/channel/UC_UMEcP_kF0z4E6KbxCpV1w">
                                    Youtube channel
                                    </a>
                                    </h3>
                                    <a target="_blank" href="https://www.youtube.com/channel/UC_UMEcP_kF0z4E6KbxCpV1w">
                                        Useful videos
                                    </a> 
                                    to improve your Javascript skills. Subscribe and stay tuned :)
                                </td>
                                <td class="unit">$0.00</td>
                                <td class="qty">100</td>
                                <td class="total">$0.00</td>
                            </tr>
                            <tr>
                                <td class="no">01</td>
                                <td class="text-left"><h3>Website Design</h3>Creating a recognizable design solution based on the company's existing visual identity</td>
                                <td class="unit">$40.00</td>
                                <td class="qty">30</td>
                                <td class="total">$1,200.00</td>
                            </tr>
                            <tr>
                                <td class="no">02</td>
                                <td class="text-left"><h3>Website Development</h3>Developing a Content Management System-based Website</td>
                                <td class="unit">$40.00</td>
                                <td class="qty">80</td>
                                <td class="total">$3,200.00</td>
                            </tr>
                            <tr>
                                <td class="no">03</td>
                                <td class="text-left"><h3>Search Engines Optimization</h3>Optimize the site for search engines (SEO)</td>
                                <td class="unit">$40.00</td>
                                <td class="qty">20</td>
                                <td class="total">$800.00</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="notices">
                        <div>NOTICE:</div>
                        <div class="notice">Note: The Apikey will become inactive after its expiration date and the API resources will become inaccessible</div>
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
</template>

<script>
import * as jspdf from 'jspdf';
import html2canvas from 'html2canvas';
export default {
    props: ['mykey'],
    data() {
        return {
            nValue: this.mykey
        }
    },
    methods: {
        printFile() { 
            const doc = new jspdf();
            let canvasElement = document.createElement('canvas');
            html2canvas(this.$refs.content.innerHTML, {canvas: canvasElement})
            .then((canvas) => {
                const img = canvas.toDataURL("image/jpeg", 0.8);
                doc.addImage(img, 'JPEG', 20, 20)
            });
            console.log('Yes, I got clicked but whatelse')        
            // var elementHandler = {
            //     '#ignorePDF': function (element, renderer) {
            //         return true;
            //     }
            // };


            doc.save("license.pdf")

            // Pdf.fromHTML(
            //     source,
            //     15,
            //     15,
            //     {
            //     'width': 180,'elementHandlers': elementHandler
            //     });

            // Pdf.save("lincens4-key.pdf");
        },


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
        console.log('PrintKey Component Mounted')
    }
}
</script>

<style scoped>
    .invoice {
        position: relative;
        background-color: #FFF;
        min-height: 680px;
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