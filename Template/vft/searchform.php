<form
    class="search header__search"
    role="search"
    method="get"
    id="searchform"
    action="<? echo home_url('/'); ?>"
>
    <input class="search__input"
		   type="text"
		   value="<? echo get_search_query(); ?>"
		   name="s" id="s"
		   placeholder="Search entire website here"
		   autocomplete="on" />
	<button id="searchsubmit" class="svg-btn" type="submit">
<svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M1.64898 12.8099L4.83894 9.72848C5.7764 10.5208 6.95592 10.9549 8.18385 10.9549C11.0528 10.9549 13.387 8.60981 13.387 5.72744C13.387 2.84508 11.0528 0.5 8.18385 0.5C5.31491 0.5 2.98075 2.84508 2.98075 5.72744C2.98075 6.80952 3.3056 7.84069 3.92228 8.72231L0.708124 11.8272C0.573974 11.957 0.5 12.1315 0.5 12.3186C0.5 12.4956 0.567188 12.6636 0.689348 12.7911C0.948824 13.062 1.3791 13.0706 1.64898 12.8099ZM12.0296 5.72744C12.0296 7.85797 10.3045 9.5912 8.18385 9.5912C6.06325 9.5912 4.33808 7.85797 4.33808 5.72744C4.33808 3.59692 6.06325 1.86368 8.18385 1.86368C10.3045 1.86368 12.0296 3.59692 12.0296 5.72744Z" fill="#7F878B"/>
</svg>
    </button>
    <ul class="ajax-search"></ul>
</form>
