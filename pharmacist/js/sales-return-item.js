const xmlhttp = new XMLHttpRequest();
const listArea = document.getElementById("bills-list");

patientName = document.getElementById("patient-name");
billDate = document.getElementById("bill-date");
reffBy = document.getElementById("reff-by");


itemList = document.getElementById("items-list");
expDate = document.getElementById("exp-date");
unit = document.getElementById("unit");
batch = document.getElementById("batch-no")
mrp = document.getElementById("mrp");
qty = document.getElementById("qty");
discount = document.getElementById("discount");
discountPrice = document.getElementById("discount-price");
gst = document.getElementById("gst")
taxable = document.getElementById("taxable");
billAmount = document.getElementById("bill-amount");


var invoiceNo = document.getElementById("invoice-no");
var refundMode = document.getElementById("refund-mode");

var returnQtyVal = document.getElementById("return");
var refund = document.getElementById("refund");






var todayDate = new Date();

var date = todayDate.getDate();
var month = todayDate.getMonth() + 1;
var year = todayDate.getFullYear();

if (date < 10) {
    date = '0' + date;
}
if (month < 10) {
    month = '0' + month;
}
var todayFullDate = year + "-" + month + "-" + date;
// console.log(todayFullDate);
document.getElementById("bill-date").setAttribute("max", todayFullDate);



const getCustomer = (invoice) => {

    if (invoice != "") {
        invoiceUrl = `ajax/return-item-list.ajax.php?invoice=${invoice}`;
        // alert(invoiceUrl);
        xmlhttp.open("GET", invoiceUrl, false);
        xmlhttp.send(null);
        // alert(xmlhttp.responseText);
        listArea.style.display = 'block';
        listArea.innerHTML = xmlhttp.responseText;
    } else {
        listArea.style.display = 'none';

        patientName.value = "";
        billDate.value = "";
        reffBy.value = "";

        expDate.value = "";
        unit.value = "";
        batch.value = "";
        mrp.value = "";
        qty.value = "";
        discount.value = "";
        gst.value = "";
        taxable.value = "";
        billAmount.value = "";
        itemList.innerHTML = '<option value="" selected disabled>Select Invoice Number First</option>';
    };
};


const getReturnDate = (date) => {
    document.getElementById('return-date').value = date;
};

const getDtls = (invoiceId, customerId) => {

    document.getElementById('invoice').value = `#${invoiceId}`;

    if (invoiceId != "" && customerId != "") {

        //==================== Reff By ====================
        patientUrl = 'ajax/stockOut.all.ajax.php?patient=' + invoiceId;
        // alert(url);
        xmlhttp.open("GET", patientUrl, false);
        xmlhttp.send(null);
        patientName.value = xmlhttp.responseText;


        //==================== Bill Date ====================
        billDateUrl = 'ajax/stockOut.all.ajax.php?bill-date=' + invoiceId;
        // alert(url);
        xmlhttp.open("GET", billDateUrl, false);
        xmlhttp.send(null);
        billDate.value = xmlhttp.responseText;
        document.getElementById('purchased-date').value = xmlhttp.responseText;


        //==================== Reff By ====================
        reffUrl = 'ajax/stockOut.all.ajax.php?reff-by=' + invoiceId;
        // alert(url);
        xmlhttp.open("GET", reffUrl, false);
        xmlhttp.send(null);
        reffBy.value = xmlhttp.responseText;


        //==================== Products List ====================
        productsUrl = 'ajax/stockOut.all.ajax.php?products=' + invoiceId;
        xmlhttp.open("GET", productsUrl, false);
        xmlhttp.send(null);
        itemList.innerHTML = xmlhttp.responseText;

        listArea.style.display = 'none';

    } else {

        patientName.value = "";
        billDate.value = "";
        reffBy.value = "";

        expDate.value = "";
        unit.value = "";
        batchNo.value = "";
        mrp.value = "";
        qty.value = "";
        discount.value = "";
        gst.value = "";
        taxable.value = "";
        billAmount.value = "";
    }
}


const getRefundMode = (ref) => {
    document.getElementById("refund-mode-val").value = ref;

}

const getItemDetails = (t) => {
    let fieldId = t.id;
    let productName = t.selectedOptions[0].text;


    let invoice = t.selectedOptions[0].getAttribute('data-invoice');
    let productId = t.value;
    let batchNo = t.selectedOptions[0].getAttribute('data-batch');


    if (t != "") {

        //==================== Exp Date Date ====================
        let expUrl = `ajax/stockOut.all.ajax.php?exp-date=${invoice}&p-id=${productId}&batch=${batchNo}`;
        xmlhttp.open("GET", expUrl, false);
        xmlhttp.send(null);
        expDate.value = xmlhttp.responseText;

        //==================== Unit ====================
        let unitUrl = `ajax/stockOut.all.ajax.php?unit=${invoice}&p-id=${productId}&batch=${batchNo}`;
        xmlhttp.open("GET", unitUrl, false);
        xmlhttp.send(null);
        unit.value = xmlhttp.responseText;

        //==================== Batch ====================
        batch.value = batchNo;

        //==================== Mrp ====================
        let mrpUrl = `ajax/stockOut.all.ajax.php?mrp=${invoice}&p-id=${productId}&batch=${batchNo}`;
        xmlhttp.open("GET", mrpUrl, false);
        xmlhttp.send(null);
        mrp.value = xmlhttp.responseText;

        //==================== QTY ====================
        let qtyUrl = `ajax/stockOut.all.ajax.php?qty=${invoice}&p-id=${productId}&batch=${batchNo}`;
        xmlhttp.open("GET", qtyUrl, false);
        xmlhttp.send(null);
        // alert(xmlhttp.responseText)
        qty.value = xmlhttp.responseText;

        //==================== DISC ====================
        let discUrl = `ajax/stockOut.all.ajax.php?disc=${invoice}&p-id=${productId}&batch=${batchNo}`;
        xmlhttp.open("GET", discUrl, false);
        xmlhttp.send(null);
        discount.value = xmlhttp.responseText;

        //==================== DISC ====================
        let dPriceUrl = `ajax/stockOut.all.ajax.php?disc-price=${invoice}&p-id=${productId}&batch=${batchNo}`;
        xmlhttp.open("GET", dPriceUrl, false);
        xmlhttp.send(null);
        discountPrice.value = xmlhttp.responseText;

        //==================== GST ====================
        let gstUrl = `ajax/stockOut.all.ajax.php?gst=${invoice}&p-id=${productId}&batch=${batchNo}`;
        xmlhttp.open("GET", gstUrl, false);
        xmlhttp.send(null);
        gst.value = xmlhttp.responseText;

        //==================== Unit ====================
        let taxableUrl = `ajax/stockOut.all.ajax.php?taxable=${invoice}&p-id=${productId}&batch=${batchNo}`;
        xmlhttp.open("GET", taxableUrl, false);
        xmlhttp.send(null);
        taxable.value = xmlhttp.responseText;

        //==================== Unit ====================
        let amountUrl = `ajax/stockOut.all.ajax.php?amount=${invoice}&p-id=${productId}&batch=${batchNo}`;
        xmlhttp.open("GET", amountUrl, false);
        xmlhttp.send(null);
        billAmount.value = xmlhttp.responseText;


        listArea.style.display = 'none';
    } else {

        expDate.value = "";
        unit.value = "";
        batchNo.value = "";
        mrp.value = "";
        qty.value = "";
        discount.value = "";
        gst.value = "";
        taxable.value = "";
        billAmount.value = "";

    }
}

const getRefund = (returnQty) => {


    if (returnQty != '') {
        if (parseFloat(returnQty) <= parseFloat(qty.value)) {
            let singlePrice = parseFloat(billAmount.value) / parseFloat(qty.value);

            let refund = singlePrice * returnQty;
            document.getElementById("refund").value = refund.toFixed(2);
            document.getElementById("add-btn").disabled = false;
        } else {
            document.getElementById("refund").value = '';
            document.getElementById("add-btn").disabled = true;
            // swal("Inserted value might be grater than sold qty.");
        }
    } else {
        // swal("Return Quantity can not be blank.");
        document.getElementById("refund").value = '';
        document.getElementById("add-btn").disabled = true;
    }
}



// ##################################################################################
// ##################################################################################

//geeting bills by clicking on add button
const addData = () => {


        if (invoiceNo.value == "") {
            invoiceNo.focus();
            return;
        }

        if (patientName.value == "") {
            patientName.focus();
            return;
        }


        if (billDate.value == "") {
            billDate.focus();
            return;
        }

        if (reffBy.value == "") {
            reffBy.focus();
            return;
        }


        if (refundMode.value == "") {
            refundMode.focus();
            return;
        }

        if (itemList.value == "") {
            itemList.focus();
        } else {}

        if (expDate.value == "") {
            expDate.focus();
            return;
        }

        if (unit.value == "") {
            unit.focus();
            return;
        }

        if (batch.value == "") {
            batch.focus();
            return;
        }

        if (mrp.value == "") {
            mrp.focus();
            return;
        }

        if (qty.value == "") {
            qty.focus();
            return;
        }

        if (discount.value == "") {
            discount.focus();
            return;
        }

        if (discountPrice.value == "") {
            discountPrice.focus();
            return;
        }

        if (gst.value == "") {
            gst.focus();
            return;
        }

        if (taxable.value == "") {
            taxable.focus();
            return;
        }

        if (billAmount.value == "") {
            billAmount.focus();
            return;
        }

        if (returnQtyVal.value == "") {
            returnQtyVal.focus();
            return;
        }


        if (refund.value == "") {
            refund.focus();
            return;
        }

        let existsItems = document.querySelectorAll('tr');
        for (let i = 0; i < existsItems.length; i++) {
            if (i > 0) {

                const item = existsItems[i];
                if (item.childNodes[5].childNodes[3].value == itemList.value) {
                    swal("You can not add same item more than one!");
                    expDate.value = "";
                    unit.value = "";
                    batch.value = "";
                    mrp.value = "";
                    qty.value = "";
                    discount.value = "";
                    gst.value = "";
                    taxable.value = "";
                    billAmount.value = "";

                    return;
                }
            }

        }

        let itemName = itemList.selectedOptions[0].text;

        let items = document.querySelectorAll('tr');
        let slno = items.length;
        document.getElementById("total-items").value = slno;

        //get total Refund Amount
        var refundAmount = document.getElementById("refund-amount");
        let totalRefund = parseFloat(refundAmount.value) + parseFloat(refund.value);
        refundAmount.value = totalRefund.toFixed(2);

        //get total item qty
        var totalQty = document.getElementById("total-qty");
        let totalQtyTemp = parseFloat(totalQty.value) + parseFloat(returnQtyVal.value);
        totalQty.value = totalQtyTemp;


        // generate gst and store 
        let gstPerItem = gst.value / 100 * refund.value;
        var gstAmount = document.getElementById("gst-amount");
        var totalGstAmount = parseFloat(gstAmount.value) + parseFloat(gstPerItem);
        gstAmount.value = totalGstAmount.toFixed(2);



        const appendData = () => {

            jQuery("#dataBody")
                .append(`<tr id="table-row-${slno}">
            <td class='text-danger pt-3'>
                <i class="fas fa-trash" id="${slno}"
                    onclick="deleteData(this.id, ${parseFloat(returnQtyVal.value)}, ${gstPerItem}, ${parseFloat(refund.value)})"></i>
            </td>
            <td class="pt-3">${slno}</td>
            <td class="pt-3">
                <input class="table-data w-12r" type="text" value="${itemName}" readonly >
                <input class="d-none" type="text" name="productId[]" value="${itemList.value}">

            </td>
            <td class="pt-3">
                <input class="table-data w-6r" type="text" name="batchNo[]" value="${batch.value}" readonly>
            </td>
            <td class="pt-3">
                <input class="table-data w-4r" type="text" name="expDate[]" value="${expDate.value}" readonly>
            </td>

            <td class="pt-3">
                <input class="table-data w-4r" type="text" name="setof[]" value="${unit.value}" readonly>
            </td>
            <td class="pt-3">
                <input class="table-data w-3r" type="text" name="qty[]" value="${qty.value}" readonly>
            </td>
            <td class="pt-3">
                <input class="table-data w-4r" type="text" name="mrp[]" value="${mrp.value}" readonly>
            </td>
            <td class="pt-3">
                <input class="table-data w-4r" type="text" name="disc[]" value="${discount.value}" readonly>
            </td>
            <td class="pt-3">
                <input class="table-data w-3r" type="text" name="gst[]" value="${gst.value}" readonly>
            </td>
            <td class="pt-3">
                <input class="table-data w-5r" type="text" name="taxable[]" value="${gstPerItem}" >
            </td>
            <td class="ps-1 pt-3">
                <input class="table-data w-4r" type="text" name="return[]" value="${returnQtyVal.value}" readonly>
            </td>
            <td class="pt-3">
                <input class="table-data w-5r" type="any" name="refund[]" value="${refund.value}" readonly>
                <input class="d-none" type="any" name="billAmount[]" value="${billAmount.value}" readonly>
            </td>
        </tr>`);
            return true;
        };

        if (appendData() == true) {
            itemList.remove(itemList.selectedIndex)
            itemList.options[0].selected = true;
            expDate.value = "";
            unit.value = "";
            batch.value = "";
            mrp.value = "";
            qty.value = "";
            discount.value = "";
            discountPrice.value = "";
            gst.value = "";
            taxable.value = "";
            billAmount.value = "";

            returnQtyVal.value = "";
            refund.value = "";
        }

    } //eof addData  

// ================================ Delet Data ================================


function deleteData(slno, returnQty, gstPerItem, itemRefund) {
    jQuery(`#table-row-${slno}`).remove();

    let existitems = document.querySelectorAll('tr');
    for (let i = 1; i < existitems.length; i++) {
        existitems[i].id = `table-row-${i}`;
        existitems[i].childNodes[1].childNodes[1].id = i;
        existitems[i].childNodes[3].innerText = i;
    }



    //minus item
    let items = document.getElementById("total-items");
    let finalItem = items.value - 1;
    items.value = finalItem;

    // minus quantity
    let qty = document.getElementById("total-qty");
    let finalQty = qty.value - returnQty
    qty.value = finalQty;


    // minus netAmount
    let gst = document.getElementById("gst-amount");
    let finalGst = parseFloat(gst.value) - parseFloat(gstPerItem);
    gst.value = finalGst.toFixed(2);


    // minus netAmount
    let refundAmount = document.getElementById("refund-amount");
    let finalAmount = refundAmount.value - itemRefund;
    refundAmount.value = finalAmount.toFixed(2);

}