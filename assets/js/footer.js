$(document).ready(function () { function e(e, i, t) { var e = e.files[0], n = e.name, o = n.split(".").pop().toLowerCase(); -1 !== ["png", "jpg", "jpeg"].indexOf(o) && e.type.startsWith("image/") ? (i.text(n), (o = new FileReader).onload = function (e) { t.attr("src", e.target.result), t.show() }, o.readAsDataURL(e)) : (i.text("Invalid file format"), t.attr("src", ""), t.hide()) } $("#file-input").on("change", function () { e(this, $("#file-label"), $("#image-preview")) }), $("#file-input-2").on("change", function () { e(this, $("#file-label-2"), $("#image-preview-2")) }), $("#file-input-3").on("change", function () { e(this, $("#file-label-3"), $("#image-preview-3")) }), $("#logout").click(function () { TokenAcc().then(function (e) { e = e.accessToken; $.ajax({ url: api_uri + "/api/auth/logout", type: "DELETE", headers: { Authorization: "Bearer " + e }, xhrFields: { withCredentials: !0, crossDomain: !0 }, success: function (e, i, t) { Cookies.remove("login_alert_shown", { path: "/" }), Cookies.remove("logout_alert_shown", { path: "/" }), window.location.href = uriLocal + "/main/_login.php?logout=success" }, error: function (e, i) { return !1 } }) }).catch(function (e) { return !1 }) }) });