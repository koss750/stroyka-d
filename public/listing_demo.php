<?php

// Function to get designs by category
function getDesignsByCategory($category) {
    $url = 'http://dev.borodin.services/api/demo/designs/df_cat_1/4';
    $response = file_get_contents($url);
    $designs = json_decode($response, true);
    return array_slice($designs, 0, 4); // Get only the first 4 designs
}

// Get designs for 'df_cat_4'
$designsCat4 = getDesignsByCategory('df_cat_4');

?>

<html>
 <link href="http://dev.borodin.uk/stroyka.html" id="dark-mode" rel="stylesheet" type="text/css"/>
 <head>
  <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
  <link href="styles.css" rel="stylesheet" type="text/css"/>
  <link href="./index_files/home1" id="dark-mode" rel="stylesheet" type="text/css"/>
  <meta content="no-cache" name="turbolinks-cache-control"/>
  <script async="" src="./index_files/tag" type="text/javascript">
  </script>
  <script defer="" src="./index_files/s1.js">
  </script>
  <script async="" src="./index_files/insight.min.js" type="text/javascript">
  </script>
  <script id="google_shimpl" src="./index_files/f.txt">
  </script>
  <script async="" src="./index_files/js" type="text/javascript">
  </script>
  <script async="" src="./index_files/config.js" type="text/javascript">
  </script>
  <script async="" src="./index_files/f(1).txt" type="text/javascript">
  </script>
  <script async="" src="./index_files/prebid-b78534b818cc797f93e478b0f5a8e9c2.js" type="text/javascript">
  </script>
  <script async="" type="text/javascript">
  </script>
  <script async="" src="./index_files/events.js" type="text/javascript">
  </script>
  <script async="" src="./index_files/fbevents.js">
  </script>
  <script async="" src="./index_files/core.js">
  </script>
  <script async="" src="./index_files/gtm.js">
  </script>
  <script async="" src="./index_files/main.15c91276.js">
  </script>
  <script async="" src="./index_files/insight.old.min.js">
  </script>
  <script defer="" src="./index_files/s1(1).js">
  </script>
  <script async="" src="./index_files/insight.min(1).js" type="text/javascript">
  </script>
  <script async="" src="./index_files/events(1).js" type="text/javascript">
  </script>
  <script async="" src="./index_files/fbevents(1).js">
  </script>
  <script async="" src="./index_files/core(1).js">
  </script>
  <script async="" src="./index_files/gtm(1).js">
  </script>
  <script type="text/javascript">
   window.NREUM||(NREUM={});NREUM.info={"beacon":"bam.nr-data.net","errorBeacon":"bam.nr-data.net","licenseKey":"5d3af624b0","applicationID":"106422814","transactionName":"c1tbQBMMXF9XRE5HXVFaRhsJDF1WAw==","queueTime":0,"applicationTime":61,"agent":""}
  </script>
  <script type="text/javascript">
   (window.NREUM||(NREUM={})).init={ajax:{deny_list:["bam.nr-data.net"]}};(window.NREUM||(NREUM={})).loader_config={licenseKey:"5d3af624b0",applicationID:"106422814"};;/*! For license information please see nr-loader-rum-1.245.0.min.js.LICENSE.txt */
(()=>{"use strict";var e,t,n={234:(e,t,n)=>{n.d(t,{P_:()=>h,Mt:()=>m,C5:()=>s,DL:()=>w,OP:()=>j,lF:()=>N,Yu:()=>_,Dg:()=>v,CX:()=>c,GE:()=>A,sU:()=>T});var r=n(8632),i=n(9567);const a={beacon:r.ce.beacon,errorBeacon:r.ce.errorBeacon,licenseKey:void 0,applicationID:void 0,sa:void 0,queueTime:void 0,applicationTime:void 0,ttGuid:void 0,user:void 0,account:void 0,product:void 0,extra:void 0,jsAttributes:{},userAttributes:void 0,atts:void 0,transactionName:void 0,tNamePlain:void 0},o={};function s(e){if(!e)throw new Error("All info objects require an agent identifier!");if(!o[e])throw new Error("Info for ".concat(e," was never set"));return o[e]}function c(e,t){if(!e)throw new Error("All info objects require an agent identifier!");o[e]=(0,i.D)(t,a),(0,r.Qy)(e,o[e],"info")}const d=e=>{if(!e||"string"!=typeof e)return!1;try{document.createDocumentFragment().querySelector(e)}catch{return!1}return!0};var u=n(7056),l=n(50);const f=()=>{const e={mask_selector:"*",block_selector:"[data-nr-block]",mask_input_options:{color:!1,date:!1,"datetime-local":!1,email:!1,month:!1,number:!1,range:!1,search:!1,tel:!1,text:!1,time:!1,url:!1,week:!1,textarea:!1,select:!1,password:!0}};return{proxy:{assets:void 0,beacon:void 0},privacy:{cookies_enabled:!0},ajax:{deny_list:void 0,block_internal:!0,enabled:!0,harvestTimeSeconds:10,autoStart:!0},distributed_tracing:{enabled:void 0,exclude_newrelic_header:void 0,cors_use_newrelic_header:void 0,cors_use_tracecontext_headers:void 0,allowed_origins:void 0},session:{domain:void 0,expiresMs:u.oD,inactiveMs:u.Hb},ssl:void 0,obfuscate:void 0,jserrors:{enabled:!0,harvestTimeSeconds:10,autoStart:!0},metrics:{enabled:!0,autoStart:!0},page_action:{enabled:!0,harvestTimeSeconds:30,autoStart:!0},page_view_event:{enabled:!0,autoStart:!0},page_view_timing:{enabled:!0,harvestTimeSeconds:30,long_task:!1,autoStart:!0},session_trace:{enabled:!0,harvestTimeSeconds:10,autoStart:!0},harvest:{tooManyRequestsDelay:60},session_replay:{autoStart:!0,enabled:!1,harvestTimeSeconds:60,sampling_rate:50,error_sampling_rate:50,collect_fonts:!1,inline_images:!1,inline_stylesheet:!0,mask_all_inputs:!0,get mask_text_selector(){return e.mask_selector},set mask_text_selector(t){d(t)?e.mask_selector=t+",[data-nr-mask]":null===t?e.mask_selector=t:(0,l.Z)("An invalid session_replay.mask_selector was provided and will not be used",t)},get block_class(){return"nr-block"},get ignore_class(){return"nr-ignore"},get mask_text_class(){return"nr-mask"},get block_selector(){return e.block_selector},set block_selector(t){d(t)?e.block_selector+=",".concat(t):""!==t&&(0,l.Z)("An invalid session_replay.block_selector was provided and will not be used",t)},get mask_input_options(){return e.mask_input_options},set mask_input_options(t){t&&"object"==typeof t?e.mask_input_options={...t,password:!0}:(0,l.Z)("An invalid session_replay.mask_input_option was provided and will not be used",t)}},spa:{enabled:!0,harvestTimeSeconds:10,autoStart:!0}}},g={},p="All configuration objects require an agent identifier!";function h(e){if(!e)throw new Error(p);if(!g[e])throw new Error("Configuration for ".concat(e," was never set"));return g[e]}function v(e,t){if(!e)throw new Error(p);g[e]=(0,i.D)(t,f()),(0,r.Qy)(e,g[e],"config")}function m(e,t){if(!e)throw new Error(p);var n=h(e);if(n){for(var r=t.split("."),i=0;i<r.length-1;i++)if("object"!=typeof(n=n[r[i]]))return;n=n[r[r.length-1]]}return n}const b={accountID:void 0,trustKey:void 0,agentID:void 0,licenseKey:void 0,applicationID:void 0,xpid:void 0},y={};function w(e){if(!e)throw new Error("All loader-config objects require an agent identifier!");if(!y[e])throw new Error("LoaderConfig for ".concat(e," was never set"));return y[e]}function A(e,t){if(!e)throw new Error("All loader-config objects require an agent identifier!");y[e]=(0,i.D)(t,b),(0,r.Qy)(e,y[e],"loader_config")}const _=(0,r.mF)().o;var x=n(385),D=n(6818);const k={buildEnv:D.Re,customTransaction:void 0,disabled:!1,distMethod:D.gF,isolatedBacklog:!1,loaderType:void 0,maxBytes:3e4,offset:Math.floor(x._A?.performance?.timeOrigin||x._A?.performance?.timing?.navigationStart||Date.now()),onerror:void 0,origin:""+x._A.location,ptid:void 0,releaseIds:{},session:void 0,xhrWrappable:"function"==typeof x._A.XMLHttpRequest?.prototype?.addEventListener,version:D.q4,denyList:void 0},E={};function j(e){if(!e)throw new Error("All runtime objects require an agent identifier!");if(!E[e])throw new Error("Runtime for ".concat(e," was never set"));return E[e]}function T(e,t){if(!e)throw new Error("All runtime objects require an agent identifier!");E[e]=(0,i.D)(t,k),(0,r.Qy)(e,E[e],"runtime")}function N(e){return function(e){try{const t=s(e);return!!t.licenseKey&&!!t.errorBeacon&&!!t.applicationID}catch(e){return!1}}(e)}},9567:(e,t,n)=>{n.d(t,{D:()=>i});var r=n(50);function i(e,t){try{if(!e||"object"!=typeof e)return(0,r.Z)("Setting a Configurable requires an object as input");if(!t||"object"!=typeof t)return(0,r.Z)("Setting a Configurable requires a model to set its initial properties");const n=Object.create(Object.getPrototypeOf(t),Object.getOwnPropertyDescriptors(t)),a=0===Object.keys(n).length?e:n;for(let o in a)if(void 0!==e[o])try{"object"==typeof e[o]&&"object"==typeof t[o]?n[o]=i(e[o],t[o]):n[o]=e[o]}catch(e){(0,r.Z)("An error occurred while setting a property of a Configurable",e)}return n}catch(e){(0,r.Z)("An error occured while setting a Configurable",e)}}},6818:(e,t,n)=>{n.d(t,{Re:()=>i,gF:()=>a,q4:()=>r});const r="1.245.0",i="PROD",a="CDN"},385:(e,t,n)=>{n.d(t,{Nk:()=>u,Tt:()=>s,_A:()=>a,cv:()=>l,iS:()=>o,il:()=>r,ux:()=>c,v6:()=>i,w1:()=>d});const r="undefined"!=typeof window&&!!window.document,i="undefined"!=typeof WorkerGlobalScope&&("undefined"!=typeof self&&self instanceof WorkerGlobalScope&&self.navigator instanceof WorkerNavigator||"undefined"!=typeof globalThis&&globalThis instanceof WorkerGlobalScope&&globalThis.navigator instanceof WorkerNavigator),a=r?window:"undefined"!=typeof WorkerGlobalScope&&("undefined"!=typeof self&&self instanceof WorkerGlobalScope&&self||"undefined"!=typeof globalThis&&globalThis instanceof WorkerGlobalScope&&globalThis),o=Boolean("hidden"===a?.document?.visibilityState),s=(a?.location,/iPad|iPhone|iPod/.test(a.navigator?.userAgent)),c=s&&"undefined"==typeof SharedWorker,d=((()=>{const e=a.navigator?.userAgent?.match(/Firefox[/\s](\d+\.\d+)/);Array.isArray(e)&&e.length>=2&&e[1]})(),Boolean(r&&window.document.documentMode)),u=!!a.navigator?.sendBeacon,l=Math.floor(a?.performance?.timeOrigin||a?.performance?.timing?.navigationStart||Date.now())},1117:(e,t,n)=>{n.d(t,{w:()=>a});var r=n(50);const i={agentIdentifier:"",ee:void 0};class a{constructor(e){try{if("object"!=typeof e)return(0,r.Z)("shared context requires an object as input");this.sharedContext={},Object.assign(this.sharedContext,i),Object.entries(e).forEach((e=>{let[t,n]=e;Object.keys(i).includes(t)&&(this.sharedContext[t]=n)}))}catch(e){(0,r.Z)("An error occured while setting SharedContext",e)}}}},8e3:(e,t,n)=>{n.d(t,{L:()=>u,R:()=>c});var r=n(8325),i=n(1284),a=n(4322),o=n(3325);const s={};function c(e,t){const n={staged:!1,priority:o.p[t]||0};d(e),s[e].get(t)||s[e].set(t,n)}function d(e){e&&(s[e]||(s[e]=new Map))}function u(){let e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"",t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"feature";if(d(e),!e||!s[e].get(t))return o(t);s[e].get(t).staged=!0;const n=[...s[e]];function o(t){const n=e?r.ee.get(e):r.ee,o=a.X.handlers;if(n.backlog&&o){var s=n.backlog[t],c=o[t];if(c){for(var d=0;s&&d<s.length;++d)l(s[d],c);(0,i.D)(c,(function(e,t){(0,i.D)(t,(function(t,n){n[0].on(e,n[1])}))}))}delete o[t],n.backlog[t]=null,n.emit("drain-"+t,[])}}n.every((e=>{let[t,n]=e;return n.staged}))&&(n.sort(((e,t)=>e[1].priority-t[1].priority)),n.forEach((t=>{let[n]=t;s[e].delete(n),o(n)})))}function l(e,t){var n=e[1];(0,i.D)(t[n],(function(t,n){var r=e[0];if(n[0]===r){var i=n[1],a=e[3],o=e[2];i.apply(a,o)}}))}},8325:(e,t,n)=>{n.d(t,{A:()=>c,ee:()=>d});var r=n(8632),i=n(2210),a=n(234);class o{constructor(e){this.contextId=e}}var s=n(3117);const c="nr@context:".concat(s.a),d=function e(t,n){var r={},s={},u={},f=!1;try{f=16===n.length&&(0,a.OP)(n).isolatedBacklog}catch(e){}var g={on:h,addEventListener:h,removeEventListener:function(e,t){var n=r[e];if(!n)return;for(var i=0;i<n.length;i++)n[i]===t&&n.splice(i,1)},emit:function(e,n,r,i,a){!1!==a&&(a=!0);if(d.aborted&&!i)return;t&&a&&t.emit(e,n,r);for(var o=p(r),c=v(e),u=c.length,l=0;l<u;l++)c[l].apply(o,n);var f=b()[s[e]];f&&f.push([g,e,n,o]);return o},get:m,listeners:v,context:p,buffer:function(e,t){const n=b();if(t=t||"feature",g.aborted)return;Object.entries(e||{}).forEach((e=>{let[r,i]=e;s[i]=t,t in n||(n[t]=[])}))},abort:l,aborted:!1,isBuffering:function(e){return!!b()[s[e]]},debugId:n,backlog:f?{}:t&&"object"==typeof t.backlog?t.backlog:{}};return g;function p(e){return e&&e instanceof o?e:e?(0,i.X)(e,c,(()=>new o(c))):new o(c)}function h(e,t){r[e]=v(e).concat(t)}function v(e){return r[e]||[]}function m(t){return u[t]=u[t]||e(g,t)}function b(){return g.backlog}}(void 0,"globalEE"),u=(0,r.fP)();function l(){d.aborted=!0,d.backlog={}}u.ee||(u.ee=d)},5546:(e,t,n)=>{n.d(t,{E:()=>r,p:()=>i});var r=n(8325).ee.get("handle");function i(e,t,n,i,a){a?(a.buffer([e],i),a.emit(e,t,n)):(r.buffer([e],i),r.emit(e,t,n))}},4322:(e,t,n)=>{n.d(t,{X:()=>a});var r=n(5546);a.on=o;var i=a.handlers={};function a(e,t,n,a){o(a||r.E,i,e,t,n)}function o(e,t,n,i,a){a||(a="feature"),e||(e=r.E);var o=t[a]=t[a]||{};(o[n]=o[n]||[]).push([e,i])}},3239:(e,t,n)=>{n.d(t,{bP:()=>s,iz:()=>c,m$:()=>o});var r=n(385);let i=!1,a=!1;try{const e={get passive(){return i=!0,!1},get signal(){return a=!0,!1}};r._A.addEventListener("test",null,e),r._A.removeEventListener("test",null,e)}catch(e){}function o(e,t){return i||a?{capture:!!e,passive:i,signal:t}:!!e}function s(e,t){let n=arguments.length>2&&void 0!==arguments[2]&&arguments[2],r=arguments.length>3?arguments[3]:void 0;window.addEventListener(e,t,o(n,r))}function c(e,t){let n=arguments.length>2&&void 0!==arguments[2]&&arguments[2],r=arguments.length>3?arguments[3]:void 0;document.addEventListener(e,t,o(n,r))}},3117:(e,t,n)=>{n.d(t,{a:()=>r});const r=(0,n(4402).Rl)()},4402:(e,t,n)=>{n.d(t,{Rl:()=>o,ky:()=>s});var r=n(385);const i="xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx";function a(e,t){return e?15&e[t]:16*Math.random()|0}function o(){const e=r._A?.crypto||r._A?.msCrypto;let t,n=0;return e&&e.getRandomValues&&(t=e.getRandomValues(new Uint8Array(31))),i.split("").map((e=>"x"===e?a(t,++n).toString(16):"y"===e?(3&a()|8).toString(16):e)).join("")}function s(e){const t=r._A?.crypto||r._A?.msCrypto;let n,i=0;t&&t.getRandomValues&&(n=t.getRandomValues(new Uint8Array(31)));const o=[];for(var s=0;s<e;s++)o.push(a(n,++i).toString(16));return o.join("")}},7056:(e,t,n)=>{n.d(t,{Bq:()=>r,Hb:()=>a,oD:()=>i});const r="NRBA",i=144e5,a=18e5},7894:(e,t,n)=>{function r(){return Math.round(performance.now())}n.d(t,{z:()=>r})},50:(e,t,n)=>{function r(e,t){"function"==typeof console.warn&&(console.warn("New Relic: ".concat(e)),t&&console.warn(t))}n.d(t,{Z:()=>r})},2587:(e,t,n)=>{n.d(t,{N:()=>c,T:()=>d});var r=n(8325),i=n(5546),a=n(3325);const o={stn:[a.D.sessionTrace],err:[a.D.jserrors,a.D.metrics],ins:[a.D.pageAction],spa:[a.D.spa],sr:[a.D.sessionReplay,a.D.sessionTrace]},s=new Set;function c(e,t){const n=r.ee.get(t);e&&"object"==typeof e&&(s.has(t)||Object.entries(e).forEach((e=>{let[t,r]=e;o[t]?o[t].forEach((e=>{r?(0,i.p)("feat-"+t,[],void 0,e,n):(0,i.p)("block-"+t,[],void 0,e,n),(0,i.p)("rumresp-"+t,[Boolean(r)],void 0,e,n)})):r&&(0,i.p)("feat-"+t,[],void 0,void 0,n),d[t]=Boolean(r)})),Object.keys(o).forEach((e=>{void 0===d[e]&&(o[e]?.forEach((t=>(0,i.p)("rumresp-"+e,[!1],void 0,t,n))),d[e]=!1)})),s.add(t))}const d={}},2210:(e,t,n)=>{n.d(t,{X:()=>i});var r=Object.prototype.hasOwnProperty;function i(e,t,n){if(r.call(e,t))return e[t];var i=n();if(Object.defineProperty&&Object.keys)try{return Object.defineProperty(e,t,{value:i,writable:!0,enumerable:!1}),i}catch(e){}return e[t]=i,i}},1284:(e,t,n)=>{n.d(t,{D:()=>r});const r=(e,t)=>Object.entries(e||{}).map((e=>{let[n,r]=e;return t(n,r)}))},4351:(e,t,n)=>{n.d(t,{P:()=>a});var r=n(8325);const i=()=>{const e=new WeakSet;return(t,n)=>{if("object"==typeof n&&null!==n){if(e.has(n))return;e.add(n)}return n}};function a(e){try{return JSON.stringify(e,i())}catch(e){try{r.ee.emit("internal-error",[e])}catch(e){}}}},3960:(e,t,n)=>{n.d(t,{K:()=>o,b:()=>a});var r=n(3239);function i(){return"undefined"==typeof document||"complete"===document.readyState}function a(e,t){if(i())return e();(0,r.bP)("load",e,t)}function o(e){if(i())return e();(0,r.iz)("DOMContentLoaded",e)}},8632:(e,t,n)=>{n.d(t,{EZ:()=>d,Qy:()=>c,ce:()=>a,fP:()=>o,gG:()=>u,mF:()=>s});var r=n(7894),i=n(385);const a={beacon:"bam.nr-data.net",errorBeacon:"bam.nr-data.net"};function o(){return i._A.NREUM||(i._A.NREUM={}),void 0===i._A.newrelic&&(i._A.newrelic=i._A.NREUM),i._A.NREUM}function s(){let e=o();return e.o||(e.o={ST:i._A.setTimeout,SI:i._A.setImmediate,CT:i._A.clearTimeout,XHR:i._A.XMLHttpRequest,REQ:i._A.Request,EV:i._A.Event,PR:i._A.Promise,MO:i._A.MutationObserver,FETCH:i._A.fetch}),e}function c(e,t,n){let i=o();const a=i.initializedAgents||{},s=a[e]||{};return Object.keys(s).length||(s.initializedAt={ms:(0,r.z)(),date:new Date}),i.initializedAgents={...a,[e]:{...s,[n]:t}},i}function d(e,t){o()[e]=t}function u(){return function(){let e=o();const t=e.info||{};e.info={beacon:a.beacon,errorBeacon:a.errorBeacon,...t}}(),function(){let e=o();const t=e.init||{};e.init={...t}}(),s(),function(){let e=o();const t=e.loader_config||{};e.loader_config={...t}}(),o()}},7956:(e,t,n)=>{n.d(t,{N:()=>i});var r=n(3239);function i(e){let t=arguments.length>1&&void 0!==arguments[1]&&arguments[1],n=arguments.length>2?arguments[2]:void 0,i=arguments.length>3?arguments[3]:void 0;(0,r.iz)("visibilitychange",(function(){if(t)return void("hidden"===document.visibilityState&&e());e(document.visibilityState)}),n,i)}},3081:(e,t,n)=>{n.d(t,{gF:()=>a,mY:()=>i,t9:()=>r,vz:()=>s,xS:()=>o});const r=n(3325).D.metrics,i="sm",a="cm",o="storeSupportabilityMetrics",s="storeEventMetrics"},7633:(e,t,n)=>{n.d(t,{t:()=>r});const r=n(3325).D.pageViewEvent},9251:(e,t,n)=>{n.d(t,{t:()=>r});const r=n(3325).D.pageViewTiming},5938:(e,t,n)=>{n.d(t,{W:()=>i});var r=n(8325);class i{constructor(e,t,n){this.agentIdentifier=e,this.aggregator=t,this.ee=r.ee.get(e),this.featureName=n,this.blocked=!1}}},7530:(e,t,n)=>{n.d(t,{j:()=>b});var r=n(3325),i=n(234),a=n(5546),o=n(8325),s=n(7894),c=n(8e3),d=n(3960),u=n(385),l=n(50),f=n(3081),g=n(8632);function p(){const e=(0,g.gG)();["setErrorHandler","finished","addToTrace","addRelease","addPageAction","setCurrentRouteName","setPageViewName","setCustomAttribute","interaction","noticeError","setUserId","setApplicationVersion","start"].forEach((t=>{e[t]=function(){for(var n=arguments.length,r=new Array(n),i=0;i<n;i++)r[i]=arguments[i];return function(t){for(var n=arguments.length,r=new Array(n>1?n-1:0),i=1;i<n;i++)r[i-1]=arguments[i];let a=[];return Object.values(e.initializedAgents).forEach((e=>{e.exposed&&e.api[t]&&a.push(e.api[t](...r))})),a.length>1?a:a[0]}(t,...r)}}))}var h=n(2587);const v=e=>{const t=e.startsWith("http");e+="/",n.p=t?e:"https://"+e};let m=!1;function b(e){let t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},b=arguments.length>2?arguments[2]:void 0,y=arguments.length>3?arguments[3]:void 0,{init:w,info:A,loader_config:_,runtime:x={loaderType:b},exposed:D=!0}=t;const k=(0,g.gG)();A||(w=k.init,A=k.info,_=k.loader_config),(0,i.Dg)(e,w||{}),(0,i.GE)(e,_||{}),A.jsAttributes??={},u.v6&&(A.jsAttributes.isWorker=!0),(0,i.CX)(e,A);const E=(0,i.P_)(e),j=[A.beacon,A.errorBeacon];m||(m=!0,E.proxy.assets&&(v(E.proxy.assets),j.push(E.proxy.assets)),E.proxy.beacon&&j.push(E.proxy.beacon)),x.denyList=[...E.ajax.deny_list||[],...E.ajax.block_internal?j:[]],(0,i.sU)(e,x),p();const T=function(e,t){t||(0,c.R)(e,"api");const g={};var p=o.ee.get(e),h=p.get("tracer"),v="api-",m=v+"ixn-";function b(t,n,r,a){const o=(0,i.C5)(e);return null===n?delete o.jsAttributes[t]:(0,i.CX)(e,{...o,jsAttributes:{...o.jsAttributes,[t]:n}}),A(v,r,!0,a||null===n?"session":void 0)(t,n)}function y(){}["setErrorHandler","finished","addToTrace","addRelease"].forEach((e=>{g[e]=A(v,e,!0,"api")})),g.addPageAction=A(v,"addPageAction",!0,r.D.pageAction),g.setCurrentRouteName=A(v,"routeName",!0,r.D.spa),g.setPageViewName=function(t,n){if("string"==typeof t)return"/"!==t.charAt(0)&&(t="/"+t),(0,i.OP)(e).customTransaction=(n||"http://custom.transaction")+t,A(v,"setPageViewName",!0)()},g.setCustomAttribute=function(e,t){let n=arguments.length>2&&void 0!==arguments[2]&&arguments[2];if("string"==typeof e){if(["string","number","boolean"].includes(typeof t)||null===t)return b(e,t,"setCustomAttribute",n);(0,l.Z)("Failed to execute setCustomAttribute.\nNon-null value must be a string, number or boolean type, but a type of <".concat(typeof t,"> was provided."))}else(0,l.Z)("Failed to execute setCustomAttribute.\nName must be a string type, but a type of <".concat(typeof e,"> was provided."))},g.setUserId=function(e){if("string"==typeof e||null===e)return b("enduser.id",e,"setUserId",!0);(0,l.Z)("Failed to execute setUserId.\nNon-null value must be a string type, but a type of <".concat(typeof e,"> was provided."))},g.setApplicationVersion=function(e){if("string"==typeof e||null===e)return b("application.version",e,"setApplicationVersion",!1);(0,l.Z)("Failed to execute setApplicationVersion. Expected <String | null>, but got <".concat(typeof e,">."))},g.start=e=>{try{const t=e?"defined":"undefined";(0,a.p)(f.xS,["API/start/".concat(t,"/called")],void 0,r.D.metrics,p);const n=Object.values(r.D);if(void 0===e)e=n;else{if((e=Array.isArray(e)&&e.length?e:[e]).some((e=>!n.includes(e))))return(0,l.Z)("Invalid feature name supplied. Acceptable feature names are: ".concat(n));e.includes(r.D.pageViewEvent)||e.push(r.D.pageViewEvent)}e.forEach((e=>{p.emit("".concat(e,"-opt-in"))}))}catch(e){(0,l.Z)("An unexpected issue occurred",e)}},g.interaction=function(){return(new y).get()};var w=y.prototype={createTracer:function(e,t){var n={},i=this,o="function"==typeof t;return(0,a.p)(m+"tracer",[(0,s.z)(),e,n],i,r.D.spa,p),function(){if(h.emit((o?"":"no-")+"fn-start",[(0,s.z)(),i,o],n),o)try{return t.apply(this,arguments)}catch(e){throw h.emit("fn-err",[arguments,this,e],n),e}finally{h.emit("fn-end",[(0,s.z)()],n)}}}};function A(e,t,n,i){return function(){return(0,a.p)(f.xS,["API/"+t+"/called"],void 0,r.D.metrics,p),i&&(0,a.p)(e+t,[(0,s.z)(),...arguments],n?null:this,i,p),n?void 0:this}}function _(){n.e(75).then(n.bind(n,7438)).then((t=>{let{setAPI:n}=t;n(e),(0,c.L)(e,"api")})).catch((()=>(0,l.Z)("Downloading runtime APIs failed...")))}return["actionText","setName","setAttribute","save","ignore","onEnd","getContext","end","get"].forEach((e=>{w[e]=A(m,e,void 0,r.D.spa)})),g.noticeError=function(e,t){"string"==typeof e&&(e=new Error(e)),(0,a.p)(f.xS,["API/noticeError/called"],void 0,r.D.metrics,p),(0,a.p)("err",[e,(0,s.z)(),!1,t],void 0,r.D.jserrors,p)},u.il?(0,d.b)((()=>_()),!0):_(),g}(e,y);return(0,g.Qy)(e,T,"api"),(0,g.Qy)(e,D,"exposed"),(0,g.EZ)("activatedFeatures",h.T),T}},3325:(e,t,n)=>{n.d(t,{D:()=>r,p:()=>i});const r={ajax:"ajax",jserrors:"jserrors",metrics:"metrics",pageAction:"page_action",pageViewEvent:"page_view_event",pageViewTiming:"page_view_timing",sessionReplay:"session_replay",sessionTrace:"session_trace",spa:"spa"},i={[r.pageViewEvent]:1,[r.pageViewTiming]:2,[r.metrics]:3,[r.jserrors]:4,[r.ajax]:5,[r.sessionTrace]:6,[r.pageAction]:7,[r.spa]:8,[r.sessionReplay]:9}}},r={};function i(e){var t=r[e];if(void 0!==t)return t.exports;var a=r[e]={exports:{}};return n[e](a,a.exports,i),a.exports}i.m=n,i.d=(e,t)=>{for(var n in t)i.o(t,n)&&!i.o(e,n)&&Object.defineProperty(e,n,{enumerable:!0,get:t[n]})},i.f={},i.e=e=>Promise.all(Object.keys(i.f).reduce(((t,n)=>(i.f[n](e,t),t)),[])),i.u=e=>"nr-rum-1.245.0.min.js",i.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),e={},t="NRBA-1.245.0.PROD:",i.l=(n,r,a,o)=>{if(e[n])e[n].push(r);else{var s,c;if(void 0!==a)for(var d=document.getElementsByTagName("script"),u=0;u<d.length;u++){var l=d[u];if(l.getAttribute("src")==n||l.getAttribute("data-webpack")==t+a){s=l;break}}s||(c=!0,(s=document.createElement("script")).charset="utf-8",s.timeout=120,i.nc&&s.setAttribute("nonce",i.nc),s.setAttribute("data-webpack",t+a),s.src=n),e[n]=[r];var f=(t,r)=>{s.onerror=s.onload=null,clearTimeout(g);var i=e[n];if(delete e[n],s.parentNode&&s.parentNode.removeChild(s),i&&i.forEach((e=>e(r))),t)return t(r)},g=setTimeout(f.bind(null,void 0,{type:"timeout",target:s}),12e4);s.onerror=f.bind(null,s.onerror),s.onload=f.bind(null,s.onload),c&&document.head.appendChild(s)}},i.r=e=>{"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},i.p="https://js-agent.newrelic.com/",(()=>{var e={50:0,832:0};i.f.j=(t,n)=>{var r=i.o(e,t)?e[t]:void 0;if(0!==r)if(r)n.push(r[2]);else{var a=new Promise(((n,i)=>r=e[t]=[n,i]));n.push(r[2]=a);var o=i.p+i.u(t),s=new Error;i.l(o,(n=>{if(i.o(e,t)&&(0!==(r=e[t])&&(e[t]=void 0),r)){var a=n&&("load"===n.type?"missing":n.type),o=n&&n.target&&n.target.src;s.message="Loading chunk "+t+" failed.\n("+a+": "+o+")",s.name="ChunkLoadError",s.type=a,s.request=o,r[1](s)}}),"chunk-"+t,t)}};var t=(t,n)=>{var r,a,[o,s,c]=n,d=0;if(o.some((t=>0!==e[t]))){for(r in s)i.o(s,r)&&(i.m[r]=s[r]);if(c)c(i)}for(t&&t(n);d<o.length;d++)a=o[d],i.o(e,a)&&e[a]&&e[a][0](),e[a]=0},n=self["webpackChunk:NRBA-1.245.0.PROD"]=self["webpackChunk:NRBA-1.245.0.PROD"]||[];n.forEach(t.bind(null,0)),n.push=t.bind(null,n.push.bind(n))})(),(()=>{var e=i(50);class t{addPageAction(t,n){(0,e.Z)("Call to agent api addPageAction failed. The page action feature is not currently initialized.")}setPageViewName(t,n){(0,e.Z)("Call to agent api setPageViewName failed. The page view feature is not currently initialized.")}setCustomAttribute(t,n,r){(0,e.Z)("Call to agent api setCustomAttribute failed. The js errors feature is not currently initialized.")}noticeError(t,n){(0,e.Z)("Call to agent api noticeError failed. The js errors feature is not currently initialized.")}setUserId(t){(0,e.Z)("Call to agent api setUserId failed. The js errors feature is not currently initialized.")}setApplicationVersion(t){(0,e.Z)("Call to agent api setApplicationVersion failed. The agent is not currently initialized.")}setErrorHandler(t){(0,e.Z)("Call to agent api setErrorHandler failed. The js errors feature is not currently initialized.")}finished(t){(0,e.Z)("Call to agent api finished failed. The page action feature is not currently initialized.")}addRelease(t,n){(0,e.Z)("Call to agent api addRelease failed. The js errors feature is not currently initialized.")}start(t){(0,e.Z)("Call to agent api addRelease failed. The agent is not currently initialized.")}}var n=i(3325),r=i(234);const a=Object.values(n.D);function o(e){const t={};return a.forEach((n=>{t[n]=function(e,t){return!1!==(0,r.Mt)(t,"".concat(e,".enabled"))}(n,e)})),t}var s=i(7530);var c=i(8e3),d=i(5938),u=i(3960),l=i(385);class f extends d.W{constructor(e,t,n){let i=!(arguments.length>3&&void 0!==arguments[3])||arguments[3];super(e,t,n),this.auto=i,this.abortHandler=void 0,this.featAggregate=void 0,this.onAggregateImported=void 0,!1===(0,r.Mt)(this.agentIdentifier,"".concat(this.featureName,".autoStart"))&&(this.auto=!1),this.auto&&(0,c.R)(e,n)}importAggregator(){let t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};if(this.featAggregate)return;if(!this.auto)return void this.ee.on("".concat(this.featureName,"-opt-in"),(()=>{(0,c.R)(this.agentIdentifier,this.featureName),this.auto=!0,this.importAggregator()}));const n=l.il&&!0===(0,r.Mt)(this.agentIdentifier,"privacy.cookies_enabled");let a;this.onAggregateImported=new Promise((e=>{a=e}));const o=async()=>{let r;try{if(n){const{setupAgentSession:e}=await i.e(75).then(i.bind(i,3228));r=e(this.agentIdentifier)}}catch(t){(0,e.Z)("A problem occurred when starting up session manager. This page will not start or extend any session.",t)}try{if(!this.shouldImportAgg(this.featureName,r))return(0,c.L)(this.agentIdentifier,this.featureName),void a(!1);const{lazyFeatureLoader:e}=await i.e(75).then(i.bind(i,8582)),{Aggregate:n}=await e(this.featureName,"aggregate");this.featAggregate=new n(this.agentIdentifier,this.aggregator,t),a(!0)}catch(t){(0,e.Z)("Downloading and initializing ".concat(this.featureName," failed..."),t),this.abortHandler?.(),(0,c.L)(this.agentIdentifier,this.featureName),a(!1)}};l.il?(0,u.b)((()=>o()),!0):o()}shouldImportAgg(e,t){return e!==n.D.sessionReplay||!!r.Yu.MO&&(!1!==(0,r.Mt)(this.agentIdentifier,"session_trace.enabled")&&(!!t?.isNew||!!t?.state.sessionReplay))}}var g=i(7633);class p extends f{static featureName=g.t;constructor(e,t){let n=!(arguments.length>2&&void 0!==arguments[2])||arguments[2];super(e,t,g.t,n),this.importAggregator()}}var h=i(1117),v=i(1284);class m extends h.w{constructor(e){super(e),this.aggregatedData={}}store(e,t,n,r,i){var a=this.getBucket(e,t,n,i);return a.metrics=function(e,t){t||(t={count:0});return t.count+=1,(0,v.D)(e,(function(e,n){t[e]=b(n,t[e])})),t}(r,a.metrics),a}merge(e,t,n,r,i){var a=this.getBucket(e,t,r,i);if(a.metrics){var o=a.metrics;o.count+=n.count,(0,v.D)(n,(function(e,t){if("count"!==e){var r=o[e],i=n[e];i&&!i.c?o[e]=b(i.t,r):o[e]=function(e,t){if(!t)return e;t.c||(t=y(t.t));return t.min=Math.min(e.min,t.min),t.max=Math.max(e.max,t.max),t.t+=e.t,t.sos+=e.sos,t.c+=e.c,t}(i,o[e])}}))}else a.metrics=n}storeMetric(e,t,n,r){var i=this.getBucket(e,t,n);return i.stats=b(r,i.stats),i}getBucket(e,t,n,r){this.aggregatedData[e]||(this.aggregatedData[e]={});var i=this.aggregatedData[e][t];return i||(i=this.aggregatedData[e][t]={params:n||{}},r&&(i.custom=r)),i}get(e,t){return t?this.aggregatedData[e]&&this.aggregatedData[e][t]:this.aggregatedData[e]}take(e){for(var t={},n="",r=!1,i=0;i<e.length;i++)t[n=e[i]]=w(this.aggregatedData[n]),t[n].length&&(r=!0),delete this.aggregatedData[n];return r?t:null}}function b(e,t){return null==e?function(e){e?e.c++:e={c:1};return e}(t):t?(t.c||(t=y(t.t)),t.c+=1,t.t+=e,t.sos+=e*e,e>t.max&&(t.max=e),e<t.min&&(t.min=e),t):{t:e}}function y(e){return{t:e,min:e,max:e,sos:e*e,c:1}}function w(e){return"object"!=typeof e?[]:(0,v.D)(e,A)}function A(e,t){return t}var _=i(8632),x=i(4402),D=i(4351);var k=i(5546),E=i(7956),j=i(3239),T=i(7894),N=i(9251);class S extends f{static featureName=N.t;constructor(e,t){let n=!(arguments.length>2&&void 0!==arguments[2])||arguments[2];super(e,t,N.t,n),l.il&&((0,E.N)((()=>(0,k.p)("docHidden",[(0,T.z)()],void 0,N.t,this.ee)),!0),(0,j.bP)("pagehide",(()=>(0,k.p)("winPagehide",[(0,T.z)()],void 0,N.t,this.ee))),this.importAggregator())}}var C=i(3081);class P extends f{static featureName=C.t9;constructor(e,t){let n=!(arguments.length>2&&void 0!==arguments[2])||arguments[2];super(e,t,C.t9,n),this.importAggregator()}}new class extends t{constructor(t){let n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:(0,x.ky)(16);super(),l._A?(this.agentIdentifier=n,this.sharedAggregator=new m({agentIdentifier:this.agentIdentifier}),this.features={},this.desiredFeatures=new Set(t.features||[]),this.desiredFeatures.add(p),Object.assign(this,(0,s.j)(this.agentIdentifier,t,t.loaderType||"agent")),this.run()):(0,e.Z)("Failed to initial the agent. Could not determine the runtime environment.")}get config(){return{info:(0,r.C5)(this.agentIdentifier),init:(0,r.P_)(this.agentIdentifier),loader_config:(0,r.DL)(this.agentIdentifier),runtime:(0,r.OP)(this.agentIdentifier)}}run(){const t="features";try{const r=o(this.agentIdentifier),i=[...this.desiredFeatures];i.sort(((e,t)=>n.p[e.featureName]-n.p[t.featureName])),i.forEach((t=>{if(r[t.featureName]||t.featureName===n.D.pageViewEvent){const i=function(e){switch(e){case n.D.ajax:return[n.D.jserrors];case n.D.sessionTrace:return[n.D.ajax,n.D.pageViewEvent];case n.D.sessionReplay:return[n.D.sessionTrace];case n.D.pageViewTiming:return[n.D.pageViewEvent];default:return[]}}(t.featureName);i.every((e=>r[e]))||(0,e.Z)("".concat(t.featureName," is enabled but one or more dependent features has been disabled (").concat((0,D.P)(i),"). This may cause unintended consequences or missing data...")),this.features[t.featureName]=new t(this.agentIdentifier,this.sharedAggregator)}})),(0,_.Qy)(this.agentIdentifier,this.features,t)}catch(n){(0,e.Z)("Failed to initialize all enabled instrument classes (agent aborted) -",n);for(const e in this.features)this.features[e].abortHandler?.();const r=(0,_.fP)();return delete r.initializedAgents[this.agentIdentifier]?.api,delete r.initializedAgents[this.agentIdentifier]?.[t],delete this.sharedAggregator,r.ee?.abort(),delete r.ee?.get(this.agentIdentifier),!1}}addToTrace(t){(0,e.Z)("Call to agent api addToTrace failed. The session trace feature is not currently initialized.")}setCurrentRouteName(t){(0,e.Z)("Call to agent api setCurrentRouteName failed. The spa feature is not currently initialized.")}interaction(){(0,e.Z)("Call to agent api interaction failed. The spa feature is not currently initialized.")}}({features:[p,S,P],loaderType:"lite"})})()})();
  </script>
  <script async="" src="./index_files/fuse.js">
  </script>
  <title>
   Стройка - демо
  </title>
  <!-- SEO meta tags -->
  <link href="https://www.architecturaldesigns.com/" rel="canonical"/>
  <meta content="House Plans and Home Floor Plans | borodin.servicess" name="title"/>
  <meta content="architecturaldesigns.com" name="url"/>
  <meta content="Search our collection of 30k+ house plans by over 200 designers and architects to find the perfect home plan to build. All house plans can be modified." name="description"/>
  <meta content="house plans,home plans,floor plans,house floor plans,homeplans,houseplans,home designs,home design,architectural designs,floorplans,blueprints, custom designs, dream homes, southern, country, beach,victorian,traditional,cottage,luxury" name="keywords"/>
  <meta content="PVYhLuoYm0AEMqNGKeuHy3TDY4xWGFgsDxetfTjBIUU" name="google-site-verification"/>
  <script type="application/ld+json">
   {
"@context": "http://schema.org",
"@type": "Organization",
"name": "borodin.servicess",
"url": "https://www.architecturaldesigns.com/",
"sameAs": [
"https://www.facebook.com/Architectural.Designs.Houseplans",
"https://www.pinterest.com/archdesigns/",
"https://twitter.com/adhouseplans",
"https://www.instagram.com/adhouseplans/",
"https://www.youtube.com/user/ADHousePlans/"
]
}
  </script>
  <!-- Open Graph data -->
  <meta content="borodin.servicess - Selling quality house plans for generations" property="og:title"/>
  <meta content="borodin.servicess" property="og:site_name"/>
  <meta content="https://www.architecturaldesigns.com/" property="og:url"/>
  <meta content="Search our collection of 30k+ house plans by over 200 designers and architects to find the perfect home plan to build. All house plans can be modified." property="og:description"/>
  <meta content="website" property="og:type"/>
  <meta content="https://www.architecturaldesigns.com/assets/logo-0baf58dffe24002fac28656c197c0a8e85c6725a2e01f4b4fae66e7a061726d8.png" property="og:image"/>
  <meta content="1670722289810910" property="fb:app_id"/>
  <meta content="width=device-width, initial-scale=10, maximum-scale=1.0" name="viewport"/>
  <link data-turbolinks-track="reload" href="./index_files/plans_home-0967b0c93f9cf98b501f6f1acc579e5d75f24d8e121b2963f2ed3b56dbd882b4.css" media="all" rel="stylesheet"/>
  <script data-turbolinks-track="reload" src="./index_files/plans_home-d82ed62e1ba7dfbf0212047bf439e7e50e604107e35008d81c1fa44a02e78558.js">
  </script>
  <!-- Optimize plugin -->
  <script async="" src="./index_files/optimize.js">
  </script>
  
  <meta content="authenticity_token" name="csrf-param"/>
  <meta content="Ox_6nPB1xCHxxXN18jYjoPTBguTWIvm_Bu70I7RRVTDluqkVSO8tSlO-3IU3brf3lRbaXuPrM-uDVzWGZ9nTgg" name="csrf-token"/>
  <link href="./index_files/css" rel="stylesheet"/>
  <script src="./index_files/bb7ykz9swZqd.js" type="text/javascript">
  </script>
  <script type="text/javascript">
   function openshopperapproved(o){ var e="Microsoft Internet Explorer"!=navigator.appName?"yes":"no",n=screen.availHeight-90,r=940;return window.innerWidth<1400&&(r=620),window.open(this.href,"shopperapproved","location="+e+",scrollbars=yes,width="+r+",height="+n+",menubar=no,toolbar=no"),o.stopPropagation&&o.stopPropagation(),!1}!function(){for(var o=document.getElementsByClassName("shopperlink"),e=0,n=o.length;e<n;e++)o[e].onclick=openshopperapproved}();
  </script>
  <link href="./index_files/1198.css" rel="stylesheet" type="text/css"/>
  <meta content="As0hBNJ8h++fNYlkq8cTye2qDLyom8NddByiVytXGGD0YVE+2CEuTCpqXMDxdhOMILKoaiaYifwEvCRlJ/9GcQ8AAAB8eyJvcmlnaW4iOiJodHRwczovL2RvdWJsZWNsaWNrLm5ldDo0NDMiLCJmZWF0dXJlIjoiV2ViVmlld1hSZXF1ZXN0ZWRXaXRoRGVwcmVjYXRpb24iLCJleHBpcnkiOjE3MTk1MzI3OTksImlzU3ViZG9tYWluIjp0cnVlfQ==" http-equiv="origin-trial"/>
  <meta content="AgRYsXo24ypxC89CJanC+JgEmraCCBebKl8ZmG7Tj5oJNx0cmH0NtNRZs3NB5ubhpbX/bIt7l2zJOSyO64NGmwMAAACCeyJvcmlnaW4iOiJodHRwczovL2dvb2dsZXN5bmRpY2F0aW9uLmNvbTo0NDMiLCJmZWF0dXJlIjoiV2ViVmlld1hSZXF1ZXN0ZWRXaXRoRGVwcmVjYXRpb24iLCJleHBpcnkiOjE3MTk1MzI3OTksImlzU3ViZG9tYWluIjp0cnVlfQ==" http-equiv="origin-trial"/>
  <script src="./index_files/bb7ykz9swZqd(1).js" type="text/javascript">
  </script>
  <script type="text/javascript">
   function openshopperapproved(o){ var e="Microsoft Internet Explorer"!=navigator.appName?"yes":"no",n=screen.availHeight-90,r=940;return window.innerWidth<1400&&(r=620),window.open(this.href,"shopperapproved","location="+e+",scrollbars=yes,width="+r+",height="+n+",menubar=no,toolbar=no"),o.stopPropagation&&o.stopPropagation(),!1}!function(){for(var o=document.getElementsByClassName("shopperlink"),e=0,n=o.length;e<n;e++)o[e].onclick=openshopperapproved}();
  </script>
  <link href="./index_files/1198(1).css" rel="stylesheet" type="text/css"/>
  <meta content="AymqwRC7u88Y4JPvfIF2F37QKylC04248hLCdJAsh8xgOfe/dVJPV3XS3wLFca1ZMVOtnBfVjaCMTVudWM//5g4AAAB7eyJvcmlnaW4iOiJodHRwczovL3d3dy5nb29nbGV0YWdtYW5hZ2VyLmNvbTo0NDMiLCJmZWF0dXJlIjoiUHJpdmFjeVNhbmRib3hBZHNBUElzIiwiZXhwaXJ5IjoxNjk1MTY3OTk5LCJpc1RoaXJkUGFydHkiOnRydWV9" http-equiv="origin-trial"/>
  <script async="" src="./index_files/f(3).txt" type="text/javascript">
  </script>
  <meta content="AymqwRC7u88Y4JPvfIF2F37QKylC04248hLCdJAsh8xgOfe/dVJPV3XS3wLFca1ZMVOtnBfVjaCMTVudWM//5g4AAAB7eyJvcmlnaW4iOiJodHRwczovL3d3dy5nb29nbGV0YWdtYW5hZ2VyLmNvbTo0NDMiLCJmZWF0dXJlIjoiUHJpdmFjeVNhbmRib3hBZHNBUElzIiwiZXhwaXJ5IjoxNjk1MTY3OTk5LCJpc1RoaXJkUGFydHkiOnRydWV9" http-equiv="origin-trial"/>
 </head>
 <body class="" data-action="home1" data-ad-environment="production" data-controller="plans" data-gr-ext-installed="" data-new-gr-c-s-check-loaded="14.1133.0">
  <iframe name="__tcfapiLocator" src="./index_files/saved_resource.html" style="display: none;">
  </iframe>
  <style>
   div.viewer-footer{bottom:100px;}
  </style>
  <style>
   div.livechat_button{bottom:105px;}
  </style>
  <style>
   @media only screen and (max-width: 728px){div[data-fuse="22912449144"]{max-height: 310px !important;}}
  </style>
  <style>
   @media only screen and (max-width: 728px){div[data-fuse="22913135504"]{max-height: 150px !important;}}@media only screen and (min-width: 728px){div[data-fuse="22913135504"]{max-height: 300px !important;}}
  </style>
  <style>
   @media only screen and (max-width: 728px){div#fuse-injected-22912452447-1{max-width: 336px; max-height: 80px; overflow: hidden;}}
  </style>
  <!-- Google Tag Manager (noscript) -->
  <!-- End Google Tag Manager (noscript) -->
  <div class="env-name-production">
  </div>
  <p class="notice">
  </p>
  <p class="alert">
  </p>
  <header>
   <div class="megamenu" style="display: none;">
    <div class="menu-container">
     <div class="width-100p clearfix">
      <div class="container styles-menu-items">
       <h3>
        Top Styles
       </h3>
       <div class="row">
        <div class="col-sm-3 col-xs-6">
         <p>
          <a href="https://www.architecturaldesigns.com/house-plans/styles/country">
           Country
          </a>
         </p>
        
        </div>
       </div>
       
      </div>
      <div class="container collections-menu-items">
       <h3>
        Top Collections
       </h3>
       <div class="row">
        <div class="col-sm-3 col-xs-6">
         <p>
          <a href="https://www.architecturaldesigns.com/house-plans/collections/exclusive">
           Exclusive
          </a>
         </p>
        </div>
       </div>
       
      </div>
     </div>
    </div>
   </div>
   <div class="home-flash">
   </div>
   <div class="" id="header">
    <div class="header-top">
     <div class="container">
      <div class="row">
       <div class="col-sm-12 clearfix">
        <div class="navbar-header">
         <button aria-controls="navbar" aria-expanded="false" class="navbar-toggle collapsed" data-target="#navbar" data-toggle="collapse" type="button">
          <span class="sr-only">
           Toggle navigation
          </span>
          <span class="icon-bar">
          </span>
          <span class="icon-bar">
          </span>
          <span class="icon-bar">
          </span>
         </button>
         <a class="navbar-brand hide-print" data-turbolinks="false" href="https://www.architecturaldesigns.com/">
          <img alt="borodin.servicess" class="img-responsive hidden-xs hidden-sm" src="./index_files/logo.png" title="borodin.servicess"/>
          <img alt="borodin.servicess" class="img-responsive visible-xs visible-sm" src="./index_files/logo.png" title="borodin.servicess"/>
         </a>
        </div>
        <div class="nav-mobile hidden visible-xs hide-print">
         <div class="search-wrapper">
          <a class="btn btn-search" href="https://www.architecturaldesigns.com/house-plans/search">
           <span class="search-icon icon-inline-align">
           </span>
           Search
          </a>
          <form accept-charset="UTF-8" action="https://www.architecturaldesigns.com/house-plans/plan_number_search" class="form-inline" method="get">
           <div class="input-group search-addon sm-srch-pln-mg">
            <input class="form-control dark-input-text width-154 exampleInputsearch" id="exampleInputsearch" name="num" placeholder="By Plan Number" type="text"/>
            <button class="input-group-addon search-addon">
             <span>
              GO
             </span>
            </button>
           </div>
          </form>
         </div>
        </div>
      
       </div>
      </div>
     </div>
    </div>
    <div class="header-filter hidden-xs">
     <div class="container">
      <div class="row slim-head">
       <div class="col-lg-12 col-md-12">
        <ul class="slim-menu clearfix">
         <li>
          <a class="btn btn-search" href="http://dev.borodin.uk/stroyka.html#">
           <span class="search-icon icon-inline-align">
           </span>
           Поиск
          </a>
         </li>
         <li>
          <a class="styles-menu-link" href="javascript:void(0);">
           Стили
          </a>
         </li>
         <li>
          <a class="collections-menu-link" href="javascript:void(0);">
           Коллекции
          </a>
         </li>
         <li>
          <a>
           Стоимость строительства
          </a>
         </li>
        </ul>
       </div>
      </div>
     </div>
    </div>
    <div class="header-filter stick-it">
     <div class="container">
      <div class="row slim-head">
       <div class="col-lg-12 col-md-12 menu-line">
        <ul class="slim-menu clearfix">
         <li>
          <a class="btn btn-search" href="http://dev.borodin.uk/stroyka.html#">
           <span class="search-icon icon-inline-align">
           </span>
           Поиск
          </a>
         </li>
         <li class="hidden-xs">
          <a class="styles-menu-link" href="javascript:void(0);">
           Стили
          </a>
         </li>
         <li class="hidden-xs">
          <a class="collections-menu-link" href="javascript:void(0);">
           Коллекции
          </a>
         </li>
         <li class="hidden-xs">
          <a>
           Стоимость строительства
          </a>
         </li>
        </ul>
        <div class="contact-hamburger">
         <div class="contact-number">
          Нужна помощь?
         </div>
         <button aria-controls="navbar" aria-expanded="false" class="navbar-toggle collapsed" data-target="#navbar" data-toggle="collapse" type="button">
          <span class="icon-bar">
          </span>
          <span class="icon-bar">
          </span>
          <span class="icon-bar">
          </span>
         </button>
        </div>
       </div>
      </div>
     </div>
    </div>
    <div id="show_sticky_header">
    </div>
    <script>
     $(function () {
    var controller_mobile = new ScrollMagic.Controller();
    new ScrollMagic.Scene({
      triggerElement: "#show_sticky_header",
      duration: 0,
      triggerHook: 0,
      reverse: true
    })
    .setClassToggle("#header", "show-stick-header")
    .addTo(controller_mobile);
  });
    </script>
   </div>
   <div class="overlay-div">
    <img height="100" src="./index_files/pageloader-a50875a3bc56c69d061d66f82b7a5f4f6d48a7ea72214d545d7eec245dcc1b70.svg" width="100"/>
   </div>
   <div class="mob-megamenu" style="display: none;">
    <div class="menu-container">
     <div class="width-100p clearfix">
      <div class="action-items">
       <a href="javascript:void(0);" id="backBtn">
        <span class="back-btn">
         Back
        </span>
       </a>
       <a href="javascript:void(0);" id="cancelBtn">
        <span class="cancel-btn">
        </span>
       </a>
      </div>
      <div class="container styles-menu-items">
       <h3>
        Section 4
       </h3>
       <div class="row">
        <div class="col-xs-12">
         <p>
          <a href="https://www.architecturaldesigns.com/house-plans/styles/farmhouse">
           Farmhouse
          </a>
         </p>
        </div>
       </div>
       <div class="row margin-top-10">
        <div class="col-sm-12">
         <a class="view-all" href="https://www.architecturaldesigns.com/house-plans/styles">
          <h4>
           View All Styles
          </h4>
          <span>
          </span>
         </a>
        </div>
       </div>
      </div>
      <div class="container collections-menu-items">
       <h3>
        Top Collections
       </h3>
       <div class="row">
        <div class="col-xs-12">
         <p>
          <a href="https://www.architecturaldesigns.com/house-plans/collections/exclusive">
           collection
          </a>
         </p>
        </div>
       </div>
       <div class="row margin-top-10">
        <div class="col-sm-12">
         <a class="view-all" href="https://www.architecturaldesigns.com/house-plans/collections">
          <h4>
           View All Collections
          </h4>
          <span>
          </span>
         </a>
        </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </header>
  <div class="plans_home plans_home1">
   <!-- / welcome messgae -->
   <div class="welcome-alert-box">
   </div>
   <!-- / slider -->
   <div id="banner">
   </div>
   <div class="home-page-slider">
    <div class="home-hero-image-container">
     <div class="visible-lg" style="background-image: url('https://assets.architecturaldesigns.com/home_desktop/1/original/Desktop_270038AF.jpg')">
     </div>
     <div class="visible-md" style="background-image: url('https://assets.architecturaldesigns.com/home_tablet_landscape/1/original/Tablet_Landscape_270038AF.jpg')">
     </div>
     <div class="visible-sm" style="background-image: url('https://assets.architecturaldesigns.com/home_tablet_potrait/1/original/Tablet_Portrait_270038AF.jpg')">
     </div>
     <div class="visible-xs" style="background-image: url('https://assets.architecturaldesigns.com/home_mobile/1/original/Mobile.jpg')">
     </div>
    </div>
    <div class="hero-image-headline">
     Тут можно купить больше чем дом..
    </div>
    <div class="basic-search home-new">
     <form accept-charset="UTF-8" action="/" method="get">
      <div class="container">
       <div id="plan_home_filter">
        <div class="filters">
          <!-- Design Category Dropdown -->
<select name="category">
    <option value="">Выберите категорию дизайна</option>
    <option value="df_cat_1">Дома из профилированного бруса</option>
    <option value="df_cat_2">Бани из клееного бруса</option>
    <option value="df_cat_3">Дома из блоков</option>
    <option value="df_cat_4">Дома из оцилиндрованного бревна</option>
    <option value="df_cat_5">Бани из бруса камерной сушки</option>
    <!-- Continue for other categories -->
    <option value="df_cat_22">Дома из бруса лиственницы</option>
</select>

<!-- Floors Dropdown -->
<select name="baseType">
    <option value="">Выберите количество этажей</option>
    <option value="1 этаж">1 этаж</option>
    <option value="2 этажа">2 этажа</option>
    <option value="2 этажа (мансарда)">2 этажа (мансарда)</option>
    <option value="2 этажа + мансарда">2 этажа + мансарда</option>
    <option value="3 этажа">3 этажа</option>
</select>
          <label for="area_min">
            Мин.площадь
           </label>
           <div id="area_min">
            <input min="0" name="size_from" placeholder="от" type="number">
           </div>
           <button class="btn btn-search" type="submit">
          <span class="search-icon icon-inline-align">
          </span>
          Найти
         </button>
        </div>
        
       </div>
      </div>
     </form>
    </div>
   </div>
   <script>
    window.plan_image_arr = null
   </script>
   <!-- / features -->
   
    <div class="container card-sliders">
     <div class="row">
      <div class="col-md-12 view-all-head">
       <div class="head-title">
        <h2 class="h1 centered">
         Хорошие планировки
        </h2>
        <p class="sub-head centered">
         Выбираем, смотрим, покупаем!
        </p>
       </div>
      </div>
     </div>
     <div class="bx-wrapper" style="max-width: 1200px;">
      
          <?php


// Output for 'df_cat_4'
foreach ($designsCat4 as $design) {
    echo "<div class='plan-card col-sm-12 col-md-4 col-lg-3 bx-clone' style='float: left; list-style: none; position: relative; width: 296.667px;'>
            <div class='sbst-listing-box has-video'>
                <a href='{$design['link']}'>
                    <div class='image-box async-bg-image' data-src='{$design['image_url']}' style='height: 182px; background-image: url(\"{$design['image_url']}\");'></div>
                </a>
                <div class='plan-sub-header'>
                    <a class='plan-caption' href='{$design['link']}'>{$design['title']}</a>
                </div>
                <a href='{$design['link']}'>
                    <ul class='info'>
                        <li><span class='h3 ft-supm-bg'>{$design['category']}</span></li>
                        <li><span class='h3 ft-supm-bg'>{$design['size']} кв.м</span></li>
                        <li><span class='h3 ft-supm-bg'>{$design['rooms']} Комнат</span></li>
                        <li><span class='h3 ft-supm-bg'>от ".number_format($design['cost'], 2, '.', '')."м руб.</span></li>
                    </ul>
                </a>
            </div>
        </div>";
}

echo "<hr>"; // Separator

// Get designs for 'df_cat_3'
$designsCat3 = getDesignsByCategory('df_cat_3');

// Output for 'df_cat_3'
foreach ($designsCat3 as $design) {
    // Similar output structure as above
    // ...
}
?>
      </div>
     </div>
    </div>
   </div>
   <!-- STATIC SECTION 1 -->
   <div id="features">
    <div class="visible-xs">
     <!-- GAM 71161633/ARCHITECTURALDESIGNS_architecturaldesigns/home_hrec_1 -->
     <div class="fuse-slot-mini-scroller" data-fuse="22912447137" data-fuse-code="fuse-slot-22912447137-1" data-fuse-processed-at="2136" data-fuse-slot="fuse-slot-22912447137-1" data-fuse-zone-instance="zone-instance-22912447137-1" style="max-height: 100px; min-height: 250px;">
      <div class="fuse-slot" id="fuse-slot-22912447137-1" style="max-width: inherit; max-height: inherit;">
      </div>
     </div>
    </div>
    <div class="container">
     <div class="row">
      <div class="col-md-12">
       <h1 class="text-center h1">
        А почему мы вообще должны у вас что то покупать?
       </h1>
      </div>
     </div>
     <div class="row margin-top-20">
      <div class="col-sm-6 col-md-3 feature-col">
       <span class="history-icon">
       </span>
       <div class="text-content">
        <h3 class="h3">
         124 года опыта
        </h3>
        <p>
         Наш семейный бизнес пережил многое. Мы гордимся нашим богатым опытом и надежностью.
        </p>
       </div>
      </div>
      <div class="col-sm-6 col-md-3 feature-col">
       <span class="portfolio-icon">
       </span>
       <div class="text-content">
        <h3 class="h3">
         Отборный Портфель
        </h3>
        <p>
         В нашем портфеле собраны проекты домов от дизайнеров и архитекторов со всей Северной Америки и за её пределами. Мы регулярно пополняем наши коллекции. Постоянно добавляем фотографии домов, построенных нашими клиентами.
        </p>
       </div>
      </div>
      <div class="col-sm-6 col-md-3 feature-col">
       <span class="cost-icon">
       </span>
       <div class="text-content">
        <h3 class="h3">
         Изменения и Стоимость строительства
        </h3>
        <p>
         Наша команда дизайнеров готова внести изменения в любой проект, будь то крупные или мелкие доработки, чтобы сделать его идеальным под ваши потребности. Наши калькуляторы быстрого расчета предоставят вам стоимость строительства конкретного проекта дома для определенного почтового индекса.
        </p>
       </div>
      </div>
      <div class="col-sm-6 col-md-3 feature-col">
       <span class="give-back-icon">
       </span>
       <div class="text-content">
        <h3 class="h3">
         Мы Помогаем
        </h3>
        <p>
         Архитектурный Дизайн с гордостью поддерживает инициативу по посадке деревьев с Ecologi, компанией, цель которой - помочь планете, уменьшая наш углеродный след.
        </p>
       </div>
      </div>
     </div>
    </div>
    <div class="container">
     <div class="row">
      <div class="col-md-12">
       <h1 class="text-center h1">
        Дополнительная секция пока своободна
       </h1>
      </div>
     </div>
     <div class="row">
      <div class="col-md-12">
       <div class="SA__wrapper" id="SA_wrapper_bb7ykz9swZqd">
       </div>
       <script>
        var sa_interval = 5000;function saLoadScript(src) { var js = window.document.createElement('script'); js.src = src; js.type = 'text/javascript'; document.getElementsByTagName("head")[0].appendChild(js); } if (typeof(shopper_first) == 'undefined') saLoadScript('https://www.shopperapproved.com/widgets/37222/merchant/rotating-widget/bb7ykz9swZqd.js');
       </script>
      </div>
     </div>
    </div>
    <div class="hidden-xs">
     <!-- GAM 71161633/ARCHITECTURALDESIGNS_architecturaldesigns/home_hrec_1 -->
     <div data-fuse="22912447137" data-fuse-code="fuse-slot-22912447137-2" data-fuse-processed-at="2137" data-fuse-slot="fuse-slot-22912447137-2" data-fuse-zone-instance="zone-instance-22912447137-2" style="max-height: 250px;">
      <div class="fuse-slot" id="fuse-slot-22912447137-2" style="max-width: inherit; max-height: inherit;">
      </div>
     </div>
    </div>
    <div class="visible-xs">
     <!-- GAM 71161633/ARCHITECTURALDESIGNS_architecturaldesigns/home_hrec_2 -->
     <div class="fuse-slot-mini-scroller" data-fuse="22912449144" data-fuse-code="fuse-slot-22912449144-1" data-fuse-processed-at="2137" data-fuse-slot="fuse-slot-22912449144-1" data-fuse-zone-instance="zone-instance-22912449144-1" style="max-height: 310px; min-height: 250px;">
      <div class="fuse-slot" id="fuse-slot-22912449144-1" style="max-width: inherit; max-height: inherit;">
      </div>
     </div>
    </div>
   </div>
    <!-- STATIC SECTION 2 -->
   <div class="price-guarantee box-light-blue">
    <div class="container">
     <div class="row clearfix">
      <div class="col-md-2 col-xs-12">
       <p class="text-center">
        <img src="./index_files/ic_price_guaranteed_2x-a8d98b3e730181cc8975397b950d05bfcefe1ed15e23a7b232f5a11210f652ad.webp" style="width: 40px;"/>
       </p>
      </div>
      <div class="col-md-10 col-xs-12">
       <h3>
        Наши цены гарантированы!
       </h3>
       <p>
        Если вы найдете более выгодную цену где-либо еще, мы с удовольствием сделаем скидку и дополнительно предоставим вам 10% скидки* на найденную цену. Это наша гарантия!
        <a href="mailto:info@architecturaldesigns.com">
         Напишите нам
        </a>
        или позвоните нам, чтобы воспользоваться этим предложением.
       </p>
       <div class="contact-info">
        <p>
         <a class="lnk-blue-underline" href="mailto:info@architecturaldesigns.com">
          web@borodin.uk
         </a>
        </p>
        <p>
         88002000600
        </p>
       </div>
       <a class="btn btn-primary learn-more" href="https://www.architecturaldesigns.com/pricing">
        Узнать больше
       </a>
       <p class="note padding-top-10">
        *Действительно при покупке проекта дома в течение 10 рабочих дней с даты вашей первоначальной покупки.
       </p>
      </div>
     </div>
    </div>
   </div>
  </div>
   <!-- FOOTER -->
  <footer id="footer">
   <!-- Same footer used for customer facing site and designer portal layout -->
   <div class="top-footer">
    <div class="container">
     <div class="link-newsletter">
      <div class="all-links">
       <section>
        <h5>
         НАЙТИ ВАШ ПЛАН
        </h5>
        <div class="links">
         <div class="link-box">
          <a href="http://dev.borodin.uk/stroyka.html#">
           Планы Домов
          </a>
          <a href="http://dev.borodin.uk/stroyka.html#">
           Горячие Планы!
          </a>
          <a href="http://dev.borodin.uk/stroyka.html#">
           Новые
          </a>
         </div>
         <div class="link-box">
          <a href="http://dev.borodin.uk/stroyka.html#">
           Стили
          </a>
          <a href="http://dev.borodin.uk/stroyka.html#">
           Коллекции
          </a>
          <a href="http://dev.borodin.uk/stroyka.html#">
           Проекты Клиентов
          </a>
         </div>
         <div class="link-box">
          <a href="http://dev.borodin.uk/stroyka.html#">
           Недавно Проданные
          </a>
          <a href="http://dev.borodin.uk/stroyka.html#">
           Самые Популярные
          </a>
         </div>
        </div>
       </section>
       <section>
        <h5>
         УСЛУГИ
        </h5>
        <div class="links">
         <div class="link-box">
          <a href="http://dev.borodin.uk/stroyka.html#">
           Что Включено
          </a>
          <a href="http://dev.borodin.uk/stroyka.html#">
           Отчет о Стоимости Строительства
          </a>
          <a href="http://dev.borodin.uk/stroyka.html#">
           Модификации
          </a>
          <a href="http://dev.borodin.uk/stroyka.html#">
           Индивидуальные Проекты
          </a>
         </div>
         <div class="link-box">
          <a href="http://dev.borodin.uk/stroyka.html#">
           Для Строителей
          </a>
          <a href="http://dev.borodin.uk/stroyka.html#">
           Для Агентов по Недвижимости
          </a>
          <a href="http://dev.borodin.uk/stroyka.html#">
           Для Дизайнеров
          </a>
          <a href="http://dev.borodin.uk/stroyka.html#">
           Стать Партнером
          </a>
          <a href="http://dev.borodin.uk/stroyka.html#">
           Запрос на Удаление Фото
          </a>
         </div>
         <div class="link-box">
          <a href="http://dev.borodin.uk/stroyka.html#">
           Изменения в Существующих Заказах
          </a>
          <a href="http://dev.borodin.uk/stroyka.html#">
           Товары и Услуги для Дома
          </a>
         </div>
        </div>
        <div class="margin-top-30">
         <h5>
          ПОЛИТИКА
         </h5>
         <div class="links">
          <div class="link-box">
           <a href="http://dev.borodin.uk/stroyka.html#">
            Политика Возврата
           </a>
           <a href="http://dev.borodin.uk/stroyka.html#">
            Политика Доставки
           </a>
          </div>
         </div>
        </div>
       </section>
       <section>
        <h5>
         О НАС
        </h5>
        <div class="links">
         <div class="link-box">
          <a href="http://dev.borodin.uk/stroyka.html#">
           Наша История
          </a>
          <a href="http://dev.borodin.uk/stroyka.html#">
           Ценообразование
          </a>
          <a href="http://dev.borodin.uk/stroyka.html#">
           Отзывы
          </a>
         </div>
         <div class="link-box">
          <a href="http://dev.borodin.uk/stroyka.html#">
           Отзывы Клиентов
          </a>
          <a href="http://dev.borodin.uk/stroyka.html#">
           Авторские Права
          </a>
          <a href="http://dev.borodin.uk/stroyka.html#">
           Часто Задаваемые Вопросы
          </a>
         </div>
         <div class="link-box">
          <a href="http://dev.borodin.uk/stroyka.html#">
           Контакты
          </a>
          <a href="http://dev.borodin.uk/stroyka.html#">
           Инициатива по Посадке Деревьев
          </a>
          <a href="http://dev.borodin.uk/stroyka.html#">
           Блог
          </a>
         </div>
        </div>
       </section>
      </div>
      <div class="newsletter-section">
       <div class="logo">
        <img alt="borodin.servicess" class="img-responsive" src="./index_files/logo-0baf58dffe24002fac28656c197c0a8e85c6725a2e01f4b4fae66e7a061726d8.webp" title="borodin.servicess"/>
       </div>
       <div class="numbers">
        <div class="country">
         РОССИЯ И СНГ
         <span>
          Звоните в любое время
         </span>
         <span>
          8-800-2000-600
         </span>
        </div>
        <div class="country">
         Великобритания
         <span>
          01622 242528
         </span>
        </div>
       </div>
      </div>
     </div>
  
    </div>
   </div>
   <div class="bottom-footer">
    <div class="container">
     <div class="copy-right">
      All house plans are copyright ©2023 by the architects and designers represented on our web site
     </div>
     <div class="links">
      <a href="https://www.architecturaldesigns.com/terms-and-conditions">
       Terms
      </a>
      <a href="https://www.architecturaldesigns.com/privacy-policy">
       Privacy Policy
      </a>
     </div>
    </div>
   </div>
   <!-- /.modal -->
  </footer>
 </body>
</html>