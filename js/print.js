function PrintElem(elem,base_url)
    {
        Popup($(elem).html(),base_url);
    }

    function Popup(data,url) 
    {
        var mywindow = window.open('', 'Impresión', 'height=400,width=600');
        mywindow.document.write('<!DOCTYPE html><html lang="es"><html><head><title>Impresión</title>');
        mywindow.document.write('<link rel="stylesheet" type="text/css" href="'+url+'/bootstrap/css/bootstrap.min.css" media="print" />');
        mywindow.document.write('<link rel="stylesheet" href="'+url+'/font-awesome/css/font-awesome.min.css" media="print" />');
        mywindow.document.write('<link rel="stylesheet" href="'+url+'/style/master.css" media="print" />');
        mywindow.document.write('</head><body style="min-width:900px;"><div class="row-fluid">');
        mywindow.document.write(data);
        mywindow.document.write('</div></body></html>');

        mywindow.print();
        mywindow.close();

        return true;
    }