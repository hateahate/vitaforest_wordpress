function vgseColumnsVisibilityUpdateHOT(e,i,n,t){var o=jQuery(".modal-columns-visibility form"),s=o.find(".columns-enabled li .js-column-key");!s.length&&window.vgseColumnsVisibilityEnabled&&(s=window.vgseColumnsVisibilityEnabled);var l=jQuery(".save_post_type_settings"),r=o.parents(".remodal").remodal(),a=o.find(".columns-enabled li .fa-refresh").parent(),u=!1;if(o.find('input[name="wpse_auto_reload_after_saving"]').val()&&(u=!0),a.length){var c=[];a.find(".column-title").each(function(){c.push(jQuery.trim(jQuery(this).text()))});var d=vgse_editor_settings.texts.confirm_column_reload_page.replace("{columns}",c.join(", "));confirm(d)&&(l.prop("checked",!0),u=!0,loading_ajax({estado:!0}))}if(!s.length)return loading_ajax({estado:!1}),"opened"===r.getState()&&r.close(),!1;if("undefined"!=typeof hot){window.vgseColumnsVisibilityEnabled=s,e=e||hot.getSettings().columns,i=i||vgse_editor_settings.colHeaders,n=n||vgse_editor_settings.colWidths;var m=[],p=[],v=[],y=[];e.forEach(function(e,t){e.vgOriginalIndex=t,m[e.data]=e},this);var f=o.find(".not-allowed-columns").val();f=f.replace("ID,","").split(",");var g=[];if(s.each(function(){var e=jQuery(this).val();g.push(e)}),(g=f.concat(g)).forEach(function(e,t){m[e]&&(p.push(m[e]),v.push(i[e]),y.push(n[e]))},this),hot.updateSettings({columns:p,colHeaders:v,colWidths:y}),!l.is(":checked")||"softUpdate"===t)return loading_ajax({estado:!1}),"opened"===r.getState()&&r.close(),!1}var h=o.find("input,select,textarea").filter(function(){return!jQuery(this).parents(".vgse-sorter-section").length}).serializeArray();return h.push({name:"extra_data",value:JSON.stringify(formToObject("columns-manager-form"))}),u&&loading_ajax({estado:!0}),jQuery.post(o.attr("action"),h,function(e){var t=o.data("callback");t&&vgseExecuteFunctionByName(t,window,{response:e,form:o}),u&&window.location.href.indexOf("wpse_no_reload=1")<0&&window.location.reload()}),u||loading_ajax({estado:!1}),r&&"opened"===r.getState()&&r.close(),!1}function vgseColumnsVisibilityEqualizeHeight(){jQuery("#vgse-columns-enabled,#vgse-columns-disabled").css("height","");var e=jQuery("#vgse-columns-enabled").height(),t=jQuery("#vgse-columns-disabled").height(),i=t<e?e:t;0<i&&jQuery("#vgse-columns-enabled,#vgse-columns-disabled").height(i)}function vgseColumnsVisibilityInit(){if(window.vgseColumnsVisibilityAlreadyInit)return!0;window.vgseColumnsVisibilityAlreadyInit=!0;var o=document.getElementById("vgse-columns-enabled"),s=document.getElementById("vgse-columns-disabled"),t=jQuery(".modal-columns-visibility");if(!o||!s)return!0;function l(){t.find(".columns-enabled li input").each(function(){jQuery(this).attr("name",jQuery(this).attr("name").replace("disallowed_column","column"))}),t.find(".columns-disabled li input").each(function(){jQuery(this).attr("name",jQuery(this).attr("name").replace(/^column/,"disallowed_column"))});var e=t.find(".columns-enabled li .js-column-key").map(function(){return jQuery(this).val()}).get().join(",");t.find(".all-allowed-columns").val(e),window.vgseColumnsVisibilityUsed=!0}function i(i,e){if(window.wpseExecutionActionOnSimilarColumns)return!0;var n=e.parent().find(".column-title").text(),o=n.replace(/(\d+)/g,"1").replace(": 1: ",":").split("1"),t=e.parents("ul").first(),s=[],l=[];if(1===o.length)return!0;if(o=[o[0],""],t.find(".column-title").each(function(){var e=jQuery(this).text(),t=e.replace(/(\d+)/g,"1").replace(": 1: ",":").split("1");t.push(""),1<vgseCountMatchingElements(o,t)&&e!==n&&(s.push(jQuery(this).parent().find(".js-column-key").val()),l.push(e))}),!s.length)return!0;window.wpseExecutionActionOnSimilarColumns=!0;var r=4<s.length?vgse_editor_settings.texts.clicks_that_will_be_saved.replace("{clicks_count}",s.length):"";r+="\n"+l.join("\n");var a=vgse_editor_settings.texts.apply_action_to_similar_columns.replace("{columns}",r);if(confirm(a)){var u=[],c=[];t.children().each(function(){var e=jQuery(this),t=e.find(".js-column-key").val();-1<s.indexOf(t)&&(".remove-column"!==i&&e.find(i).click(),u.push(e.find(i).parent()),c.push(t))}),".remove-column"===i&&d(c,u)}window.wpseExecutionActionOnSimilarColumns=!1}function d(e,t){return t.forEach(function(e){e.remove()}),jQuery.post(ajaxurl,{action:"vgse_remove_column",nonce:jQuery('.modal-columns-visibility input[name="wpsecv_nonce"]').val(),post_type:jQuery('.modal-columns-visibility input[name="wpsecv_post_type"]').val(),column_key:e},function(e){e.success?l():notification({mensaje:e.data.message,tipo:"error",tiempo:3e4})}),!1}vgseColumnsVisibilityEqualizeHeight(),window.enabledSortable=Sortable.create(o,{group:"vgseColumns",animation:100,onSort:function(e){l()}}),window.disabledSortable=Sortable.create(s,{group:{name:"vgseColumns"},animation:100}),jQuery("body").on("click",".modal-columns-visibility .vgse-change-all-states",function(e){e.preventDefault(),"disabled"===jQuery(this).data("to")?jQuery(o).find("li:visible").appendTo(jQuery(s)):jQuery(s).find("li:visible").appendTo(jQuery(o)),l()}),jQuery("body").on("submit",".modal-columns-visibility  form",function(e){e.preventDefault(),l();var t=vgseColumnsVisibilityUpdateHOT(null,null,null,"hardUpdate");return"boolean"==typeof t&&t}),jQuery("body").on("click",".modal-columns-visibility  .vgse-restore-removed-columns",function(e){e.preventDefault(),jQuery.post(ajaxurl,{action:"vgse_restore_columns",nonce:jQuery('.modal-columns-visibility input[name="wpsecv_nonce"]').val(),post_type:jQuery('.modal-columns-visibility input[name="wpsecv_post_type"]').val()},function(e){e.success?alert(e.data.message):notification({mensaje:e.data.message,tipo:"error",tiempo:3e4})})}),jQuery("body").on("click",".modal-columns-visibility   .deactivate-column",function(e){if((e.preventDefault(),window.hot&&!window.wpseExecutionActionOnSimilarColumns)&&beGetModifiedItems().length)return alert(vgse_editor_settings.texts.save_changes_before_remove_column),!0;i(".deactivate-column",jQuery(this)),$column=jQuery(this).parent(),$column.appendTo(".modal-columns-visibility .columns-disabled"),l()}),jQuery("body").on("click",".modal-columns-visibility   .enable-column",function(e){e.preventDefault(),i(".enable-column",jQuery(this)),$column=jQuery(this).parent(),$column.appendTo(".modal-columns-visibility .columns-enabled"),l()}),jQuery("body").on("click",".modal-columns-visibility   .remove-column",function(e){if((e.preventDefault(),window.hot)&&beGetModifiedItems().length)return alert(vgse_editor_settings.texts.save_changes_before_remove_column),!0;var t=jQuery(this);return i(".remove-column",jQuery(this)),d([t.parent().find(".js-column-key").val()],[t.parent()])}),l(),jQuery("body").on("change",".vgse-sorter-section .wpse-bulk-action",function(e){var t=jQuery(this).val();if("disable"===t)jQuery(o).find("li:visible").appendTo(jQuery(s));else if("enable"===t)jQuery(s).find("li:visible").appendTo(jQuery(o));else if("sort_alphabetically_asc"===t){(n=(i=jQuery(this).parents(".vgse-sorter-section").find("ul")).children("li").get()).sort(function(e,t){var i=jQuery(e).find(".column-title").text().toUpperCase(),n=jQuery(t).find(".column-title").text().toUpperCase(),o=i.localeCompare(n);jQuery.isNumeric(i)&&jQuery.isNumeric(n)&&(o=(i=parseInt(i))-(n=parseInt(n)));return o}),jQuery.each(n,function(e,t){i.append(t)})}else if("sort_alphabetically_desc"===t){var i,n;(n=(i=jQuery(this).parents(".vgse-sorter-section").find("ul")).children("li").get()).sort(function(e,t){var i=jQuery(e).find(".column-title").text().toUpperCase(),n=jQuery(t).find(".column-title").text().toUpperCase(),o=i.localeCompare(n);jQuery.isNumeric(i)&&jQuery.isNumeric(n)&&(o=(i=parseInt(i))-(n=parseInt(n)));return o}),n.reverse(),jQuery.each(n,function(e,t){i.append(t)})}else"delete"===t&&jQuery(s).find("li:visible .remove-column").each(function(){jQuery(this).click()});jQuery(this).val(""),jQuery(this).parent().find("input").val("").trigger("change"),l()}),jQuery("body").on("click",".vgse-sorter-section .toggle-search-button",function(e){e.preventDefault(),t.find(".wpse-columns-bulk-actions").toggle(),jQuery(this).parents(".vgse-sorter-section").find(".wpse-columns-bulk-actions input").focus()}),jQuery("body").on("keypress",".vgse-sorter-section .wpse-filter-list",function(e){if(13==e.keyCode)return e.preventDefault(),!1}),jQuery("body").on("keyup change",".vgse-sorter-section .wpse-filter-list",_throttle(function(e){var t=jQuery(this).val(),i=jQuery(this).parents(".vgse-sorter-section");if(t){t.toLowerCase();i.find(".column-title").each(function(){jQuery(this).text().toLowerCase().indexOf(t)<0?jQuery(this).parent().hide():jQuery(this).parent().show()})}else i.find("li").show()},800,!0))}jQuery(document).on("opened",".modal-columns-visibility",function(){vgseColumnsVisibilityInit(),vgseColumnsVisibilityEqualizeHeight()}),jQuery(window).on("load",function(){jQuery("body").on("click",".wpse-toggle-head",function(){jQuery(this).next(".wpse-toggle-content").find(".modal-columns-visibility").length&&(vgseColumnsVisibilityEqualizeHeight(),vgseColumnsVisibilityInit())})}),jQuery(document).ready(function(){if("undefined"==typeof hot||!jQuery(".modal-columns-visibility").length)return!0;var e=hot.getSettings().contextMenu;void 0===e.items&&(e.items={}),e.items.wpse_hide_column={name:vgse_editor_settings.texts.hide_column,hidden:function(){if(!hot.getSelected())return!0;var e=hot.colToProp(hot.getSelected()[0][1]),t=vgse_editor_settings.final_spreadsheet_columns_settings[e];return t&&!t.allow_to_hide},callback:function(e,t,i){if(beGetModifiedItems().length)alert(vgse_editor_settings.texts.save_changes_before_remove_column);else{vgseColumnsVisibilityInit();var s=jQuery(".modal-columns-visibility");t.forEach(function(e){for(var t=e.start.col>e.end.col?e.end.col:e.start.col,i=e.start.col>e.end.col?e.start.col:e.end.col,n=[],o=t;o<=i;o++)n.push(o);n.forEach(function(e){var t=hot.colToProp(e);s.find('.columns-enabled .js-column-key[value="'+t+'"]').parent("li").appendTo(s.find(".columns-disabled"))})}),s.find(".save_post_type_settings").prop("checked",!0),s.find("form").submit(),notification({mensaje:vgse_editor_settings.texts.column_removed,tipo:"success",tiempo:4e4})}}},e.items.wpse_open_columns_visibility={name:vgse_editor_settings.texts.open_columns_visibility,callback:function(e,t,i){jQuery(".modal-columns-visibility").remodal().open()}},hot.updateSettings({contextMenu:e})});