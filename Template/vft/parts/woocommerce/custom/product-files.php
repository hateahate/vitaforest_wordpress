<?
echo do_shortcode('[woocommerce_product_documents]');
?>
<script id="tab-files-check">
let fileTab = document.querySelector('#tab-files');
let fileInner = fileTab.querySelector('.product-file__element');
	if(fileInner == null){
		fileTab.innerHTML = '<p class="no-login no-login-files no-files">There are no files attached for this product</p>';
	}
</script>