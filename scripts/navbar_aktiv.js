/**
 * Created by Prima on 03.06.14..
 */

var url = window.location;

$('ul.nav a[href="'+ url +'"]').parent().addClass('active');
$('ul.nav a[href="'+ url +'"]').parent().parent().parent().addClass('active');

$('ul.nav a').filter(function() {
    return this.href == url;
}).parent().addClass('active');

$('ul.nav a').filter(function() {
    return this.href == url;
}).parent().parent().parent().addClass('active');