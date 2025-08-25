<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Kitchen API</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://localhost";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.3.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.3.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authentification" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authentification">
                    <a href="#authentification">Authentification</a>
                </li>
                                    <ul id="tocify-subheader-authentification" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="authentification-POSTlogin">
                                <a href="#authentification-POSTlogin">POST login</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-connectedscales" class="tocify-header">
                <li class="tocify-item level-1" data-unique="connectedscales">
                    <a href="#connectedscales">ConnectedScales</a>
                </li>
                                    <ul id="tocify-subheader-connectedscales" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="connectedscales-GETconnected-scales">
                                <a href="#connectedscales-GETconnected-scales">GET connected-scales</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="connectedscales-POSTconnected-scales--connected_scale_id--associate">
                                <a href="#connectedscales-POSTconnected-scales--connected_scale_id--associate">POST connected-scales/{connected_scale_id}/associate</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="connectedscales-DELETEconnected-scales">
                                <a href="#connectedscales-DELETEconnected-scales">DELETE connected-scales</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="connectedscales-POSTconnected-scales-reserved-machine">
                                <a href="#connectedscales-POSTconnected-scales-reserved-machine">POST connected-scales/reserved-machine</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="connectedscales-POSTconnected-scales-reserved-machine-update-quantity">
                                <a href="#connectedscales-POSTconnected-scales-reserved-machine-update-quantity">POST connected-scales/reserved-machine/update-quantity</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-ingredients" class="tocify-header">
                <li class="tocify-item level-1" data-unique="ingredients">
                    <a href="#ingredients">Ingredients</a>
                </li>
                                    <ul id="tocify-subheader-ingredients" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="ingredients-GETingredients">
                                <a href="#ingredients-GETingredients">GET ingredients</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="ingredients-POSTingredients">
                                <a href="#ingredients-POSTingredients">POST ingredients</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="ingredients-GETingredients-by-type">
                                <a href="#ingredients-GETingredients-by-type">GET ingredients/by-type</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="ingredients-GETingredients-low-stock">
                                <a href="#ingredients-GETingredients-low-stock">GET ingredients/low-stock</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="ingredients-GETingredients-connected">
                                <a href="#ingredients-GETingredients-connected">GET ingredients/connected</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="ingredients-DELETEingredients-batch">
                                <a href="#ingredients-DELETEingredients-batch">DELETE ingredients/batch</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="ingredients-DELETEingredients--id-">
                                <a href="#ingredients-DELETEingredients--id-">DELETE ingredients/{id}</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="ingredients-PATCHingredients--id--quantity">
                                <a href="#ingredients-PATCHingredients--id--quantity">PATCH ingredients/{id}/quantity</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-measurementunits" class="tocify-header">
                <li class="tocify-item level-1" data-unique="measurementunits">
                    <a href="#measurementunits">MeasurementUnits</a>
                </li>
                                    <ul id="tocify-subheader-measurementunits" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="measurementunits-GETmeasurement-units">
                                <a href="#measurementunits-GETmeasurement-units">GET measurement-units</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-placetypes" class="tocify-header">
                <li class="tocify-item level-1" data-unique="placetypes">
                    <a href="#placetypes">PlaceTypes</a>
                </li>
                                    <ul id="tocify-subheader-placetypes" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="placetypes-GETplace-types">
                                <a href="#placetypes-GETplace-types">GET place-types</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-tempo" class="tocify-header">
                <li class="tocify-item level-1" data-unique="tempo">
                    <a href="#tempo">tempo</a>
                </li>
                                    <ul id="tocify-subheader-tempo" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="tempo-GETup">
                                <a href="#tempo-GETup">GET up</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="tempo-GETstorage--path-">
                                <a href="#tempo-GETstorage--path-">GET storage/{path}</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: August 25, 2025</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<p>Cette API vous permet de gérer vos opérations liées à la cuisine, y compris les recettes, les ingrédients et la planification des repas.</p>
<aside>
    <strong>Base URL</strong>: <code>http://localhost</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>To authenticate requests, include an <strong><code>Authorization</code></strong> header in the form <strong><code>"Basic {credentials}"</code></strong>.
The value of <code>{credentials}</code> should be your username/id and your password, joined with a colon (:),
and then base64-encoded.</p>
<p>All authenticated endpoints are marked with a <code>requires authentication</code> badge in the documentation below.</p>
<p>Utilisez l'authentification Basic avec vos identifiants api_username/api_password.</p>

        <h1 id="authentification">Authentification</h1>

    

                                <h2 id="authentification-POSTlogin">POST login</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTlogin">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/login" \
    --header "Authorization: Basic Entrez vos identifiants" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"username\": \"{{api_username}}\",
    \"password\": \"{{api_password}}\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/login"
);

const headers = {
    "Authorization": "Basic Entrez vos identifiants",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "username": "{{api_username}}",
    "password": "{{api_password}}"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTlogin">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">success {
 &quot;status&quot;: &quot;success&quot;,
 &quot;message&quot;: &quot;Authentification r&eacute;ussie&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">error {
 &quot;status&quot;: &quot;error&quot;,
 &quot;message&quot;: &quot;Identifiants invalides&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTlogin" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTlogin"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTlogin"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTlogin" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTlogin">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTlogin" data-method="POST"
      data-path="login"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTlogin', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTlogin"
                    onclick="tryItOut('POSTlogin');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTlogin"
                    onclick="cancelTryOut('POSTlogin');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTlogin"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTlogin"
               value="Basic Entrez vos identifiants"
               data-component="header">
    <br>
<p>Example: <code>Basic Entrez vos identifiants</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTlogin"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTlogin"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>username</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="username"                data-endpoint="POSTlogin"
               value="{{api_username}}"
               data-component="body">
    <br>
<p>Nom d'utilisateur pour l'authentification. Example: <code>{{api_username}}</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTlogin"
               value="{{api_password}}"
               data-component="body">
    <br>
<p>Mot de passe pour l'authentification. Example: <code>{{api_password}}</code></p>
        </div>
        </form>

                <h1 id="connectedscales">ConnectedScales</h1>

    

                                <h2 id="connectedscales-GETconnected-scales">GET connected-scales</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETconnected-scales">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/connected-scales" \
    --header "Authorization: Basic Entrez vos identifiants" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/connected-scales"
);

const headers = {
    "Authorization": "Basic Entrez vos identifiants",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETconnected-scales">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">success {
 &quot;data&quot;: [
   {
     &quot;id&quot;: 1,
     &quot;mac_address&quot;: &quot;00:11:22:33:44:55&quot;,
     &quot;name&quot;: &quot;Balance cuisine&quot;,
     &quot;is_online&quot;: true,
   },
   {
     &quot;id&quot;: 2,
     &quot;mac_address&quot;: &quot;AA:BB:CC:DD:EE:FF&quot;,
     &quot;name&quot;: &quot;Balance salle de bain&quot;,
     &quot;is_online&quot;: false,
   }
 ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETconnected-scales" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETconnected-scales"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETconnected-scales"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETconnected-scales" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETconnected-scales">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETconnected-scales" data-method="GET"
      data-path="connected-scales"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETconnected-scales', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETconnected-scales"
                    onclick="tryItOut('GETconnected-scales');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETconnected-scales"
                    onclick="cancelTryOut('GETconnected-scales');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETconnected-scales"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>connected-scales</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETconnected-scales"
               value="Basic Entrez vos identifiants"
               data-component="header">
    <br>
<p>Example: <code>Basic Entrez vos identifiants</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETconnected-scales"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETconnected-scales"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="connectedscales-POSTconnected-scales--connected_scale_id--associate">POST connected-scales/{connected_scale_id}/associate</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTconnected-scales--connected_scale_id--associate">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/connected-scales/1/associate" \
    --header "Authorization: Basic Entrez vos identifiants" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"ingredient_id\": 3
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/connected-scales/1/associate"
);

const headers = {
    "Authorization": "Basic Entrez vos identifiants",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "ingredient_id": 3
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTconnected-scales--connected_scale_id--associate">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">success {
 &quot;status&quot;: &quot;success&quot;,
 &quot;message&quot;: &quot;Balance associ&eacute;e avec succ&egrave;s &agrave; l&#039;ingr&eacute;dient&quot;,
 &quot;data&quot;: {
   &quot;connected_scale&quot;: {
     &quot;id&quot;: 1,
     &quot;mac_address&quot;: &quot;00:11:22:33:44:55&quot;,
     &quot;name&quot;: &quot;Balance cuisine&quot;
   },
   &quot;ingredient&quot;: {
     &quot;id&quot;: 3,
     &quot;label&quot;: &quot;Farine&quot;,
     &quot;quantity&quot;: 500,
     &quot;max_quantity&quot;: 1000,
     &quot;mesure&quot;: &quot;Grammes&quot;
   }
 }
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">not_found {
 &quot;message&quot;: &quot;Balance ou ingr&eacute;dient non trouv&eacute;&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">already_associated {
 &quot;message&quot;: &quot;Cette balance est d&eacute;j&agrave; associ&eacute;e &agrave; un autre ingr&eacute;dient&quot;,
 &quot;ingredient&quot;: {
   &quot;id&quot;: 5,
   &quot;label&quot;: &quot;Sucre&quot;
 }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTconnected-scales--connected_scale_id--associate" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTconnected-scales--connected_scale_id--associate"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTconnected-scales--connected_scale_id--associate"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTconnected-scales--connected_scale_id--associate" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTconnected-scales--connected_scale_id--associate">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTconnected-scales--connected_scale_id--associate" data-method="POST"
      data-path="connected-scales/{connected_scale_id}/associate"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTconnected-scales--connected_scale_id--associate', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTconnected-scales--connected_scale_id--associate"
                    onclick="tryItOut('POSTconnected-scales--connected_scale_id--associate');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTconnected-scales--connected_scale_id--associate"
                    onclick="cancelTryOut('POSTconnected-scales--connected_scale_id--associate');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTconnected-scales--connected_scale_id--associate"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>connected-scales/{connected_scale_id}/associate</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTconnected-scales--connected_scale_id--associate"
               value="Basic Entrez vos identifiants"
               data-component="header">
    <br>
<p>Example: <code>Basic Entrez vos identifiants</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTconnected-scales--connected_scale_id--associate"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTconnected-scales--connected_scale_id--associate"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>connected_scale_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="connected_scale_id"                data-endpoint="POSTconnected-scales--connected_scale_id--associate"
               value="1"
               data-component="url">
    <br>
<p>L'identifiant de la balance à associer. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ingredient_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="ingredient_id"                data-endpoint="POSTconnected-scales--connected_scale_id--associate"
               value="3"
               data-component="body">
    <br>
<p>L'identifiant de l'ingrédient à associer à la balance. Example: <code>3</code></p>
        </div>
        </form>

                    <h2 id="connectedscales-DELETEconnected-scales">DELETE connected-scales</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEconnected-scales">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/connected-scales" \
    --header "Authorization: Basic Entrez vos identifiants" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"mac_address\": \"00:11:22:33:44:55\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/connected-scales"
);

const headers = {
    "Authorization": "Basic Entrez vos identifiants",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "mac_address": "00:11:22:33:44:55"
};

fetch(url, {
    method: "DELETE",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEconnected-scales">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">success {
 &quot;status&quot;: &quot;success&quot;,
 &quot;message&quot;: &quot;Balance supprim&eacute;e avec succ&egrave;s&quot;,
 &quot;data&quot;: {
   &quot;mac_address&quot;: &quot;00:11:22:33:44:55&quot;,
   &quot;name&quot;: &quot;Balance cuisine&quot;
 }
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">balance_not_found {
 &quot;message&quot;: &quot;Balance non trouv&eacute;e avec cette adresse MAC&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">validation_error {
 &quot;message&quot;: &quot;Le champ adresse MAC est obligatoire&quot;,
 &quot;errors&quot;: {
   &quot;mac_address&quot;: [
     &quot;Le champ adresse MAC est obligatoire&quot;
   ]
 }
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEconnected-scales" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEconnected-scales"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEconnected-scales"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEconnected-scales" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEconnected-scales">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEconnected-scales" data-method="DELETE"
      data-path="connected-scales"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEconnected-scales', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEconnected-scales"
                    onclick="tryItOut('DELETEconnected-scales');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEconnected-scales"
                    onclick="cancelTryOut('DELETEconnected-scales');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEconnected-scales"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>connected-scales</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEconnected-scales"
               value="Basic Entrez vos identifiants"
               data-component="header">
    <br>
<p>Example: <code>Basic Entrez vos identifiants</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEconnected-scales"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEconnected-scales"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>mac_address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="mac_address"                data-endpoint="DELETEconnected-scales"
               value="00:11:22:33:44:55"
               data-component="body">
    <br>
<p>L'adresse MAC de la balance à supprimer. Example: <code>00:11:22:33:44:55</code></p>
        </div>
        </form>

                    <h2 id="connectedscales-POSTconnected-scales-reserved-machine">POST connected-scales/reserved-machine</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTconnected-scales-reserved-machine">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/connected-scales/reserved-machine" \
    --header "Authorization: Basic Entrez vos identifiants" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"mac_address\": \"00:11:22:33:44:55\",
    \"name\": \"Balance cuisine\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/connected-scales/reserved-machine"
);

const headers = {
    "Authorization": "Basic Entrez vos identifiants",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "mac_address": "00:11:22:33:44:55",
    "name": "Balance cuisine"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTconnected-scales-reserved-machine">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">success {
 &quot;data&quot;: {
   &quot;id&quot;: 3,
   &quot;mac_address&quot;: &quot;00:11:22:33:44:55&quot;,
   &quot;name&quot;: &quot;Balance cuisine&quot;,
   &quot;is_online&quot;: false,
   &quot;last_update&quot;: null
 },
 &quot;message&quot;: &quot;Balance cr&eacute;&eacute;e avec succ&egrave;s&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">validation_error {
 &quot;message&quot;: &quot;Le champ adresse MAC est obligatoire&quot;,
 &quot;errors&quot;: {
   &quot;mac_address&quot;: [
     &quot;Le champ adresse MAC est obligatoire&quot;
   ]
 }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTconnected-scales-reserved-machine" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTconnected-scales-reserved-machine"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTconnected-scales-reserved-machine"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTconnected-scales-reserved-machine" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTconnected-scales-reserved-machine">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTconnected-scales-reserved-machine" data-method="POST"
      data-path="connected-scales/reserved-machine"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTconnected-scales-reserved-machine', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTconnected-scales-reserved-machine"
                    onclick="tryItOut('POSTconnected-scales-reserved-machine');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTconnected-scales-reserved-machine"
                    onclick="cancelTryOut('POSTconnected-scales-reserved-machine');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTconnected-scales-reserved-machine"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>connected-scales/reserved-machine</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTconnected-scales-reserved-machine"
               value="Basic Entrez vos identifiants"
               data-component="header">
    <br>
<p>Example: <code>Basic Entrez vos identifiants</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTconnected-scales-reserved-machine"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTconnected-scales-reserved-machine"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>mac_address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="mac_address"                data-endpoint="POSTconnected-scales-reserved-machine"
               value="00:11:22:33:44:55"
               data-component="body">
    <br>
<p>L'adresse MAC de la balance. Example: <code>00:11:22:33:44:55</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>name</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="name"                data-endpoint="POSTconnected-scales-reserved-machine"
               value="Balance cuisine"
               data-component="body">
    <br>
<p>Le nom de la balance. Example: <code>Balance cuisine</code></p>
        </div>
        </form>

                    <h2 id="connectedscales-POSTconnected-scales-reserved-machine-update-quantity">POST connected-scales/reserved-machine/update-quantity</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTconnected-scales-reserved-machine-update-quantity">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/connected-scales/reserved-machine/update-quantity" \
    --header "Authorization: Basic Entrez vos identifiants" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"mac_address\": \"00:11:22:33:44:55\",
    \"quantity\": \"750\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/connected-scales/reserved-machine/update-quantity"
);

const headers = {
    "Authorization": "Basic Entrez vos identifiants",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "mac_address": "00:11:22:33:44:55",
    "quantity": "750"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTconnected-scales-reserved-machine-update-quantity">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">success {
 &quot;status&quot;: &quot;success&quot;,
 &quot;message&quot;: &quot;Quantit&eacute; mise &agrave; jour avec succ&egrave;s&quot;,
 &quot;data&quot;: {
   &quot;id&quot;: 3,
   &quot;label&quot;: &quot;Farine&quot;,
   &quot;quantity&quot;: 750,
   &quot;max_quantity&quot;: 1000,
   &quot;mesure&quot;: &quot;Grammes&quot;
 }
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">balance_not_found {
 &quot;message&quot;: &quot;Balance non trouv&eacute;e avec cette adresse MAC&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">ingredient_not_found {
 &quot;message&quot;: &quot;Aucun ingr&eacute;dient n&#039;est associ&eacute; &agrave; cette balance&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">validation_error {
 &quot;message&quot;: &quot;Le champ adresse MAC est obligatoire&quot;,
 &quot;errors&quot;: {
   &quot;mac_address&quot;: [
     &quot;Le champ adresse MAC est obligatoire&quot;
   ]
 }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTconnected-scales-reserved-machine-update-quantity" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTconnected-scales-reserved-machine-update-quantity"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTconnected-scales-reserved-machine-update-quantity"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTconnected-scales-reserved-machine-update-quantity" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTconnected-scales-reserved-machine-update-quantity">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTconnected-scales-reserved-machine-update-quantity" data-method="POST"
      data-path="connected-scales/reserved-machine/update-quantity"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTconnected-scales-reserved-machine-update-quantity', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTconnected-scales-reserved-machine-update-quantity"
                    onclick="tryItOut('POSTconnected-scales-reserved-machine-update-quantity');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTconnected-scales-reserved-machine-update-quantity"
                    onclick="cancelTryOut('POSTconnected-scales-reserved-machine-update-quantity');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTconnected-scales-reserved-machine-update-quantity"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>connected-scales/reserved-machine/update-quantity</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTconnected-scales-reserved-machine-update-quantity"
               value="Basic Entrez vos identifiants"
               data-component="header">
    <br>
<p>Example: <code>Basic Entrez vos identifiants</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTconnected-scales-reserved-machine-update-quantity"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTconnected-scales-reserved-machine-update-quantity"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>mac_address</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="mac_address"                data-endpoint="POSTconnected-scales-reserved-machine-update-quantity"
               value="00:11:22:33:44:55"
               data-component="body">
    <br>
<p>L'adresse MAC de la balance. Example: <code>00:11:22:33:44:55</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>quantity</code></b>&nbsp;&nbsp;
<small>numeric</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="quantity"                data-endpoint="POSTconnected-scales-reserved-machine-update-quantity"
               value="750"
               data-component="body">
    <br>
<p>La nouvelle quantité à définir. Example: <code>750</code></p>
        </div>
        </form>

                <h1 id="ingredients">Ingredients</h1>

    

                                <h2 id="ingredients-GETingredients">GET ingredients</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETingredients">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/ingredients" \
    --header "Authorization: Basic Entrez vos identifiants" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/ingredients"
);

const headers = {
    "Authorization": "Basic Entrez vos identifiants",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETingredients">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">success {
 &quot;data&quot;: [
   {
     &quot;id&quot;: 1,
     &quot;label&quot;: &quot;Tomate&quot;,
     &quot;quantity&quot;: 10,
     &quot;max_quantity&quot;: 20,
     &quot;mesure&quot;: &quot;Grammes&quot;
   }
 ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETingredients" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETingredients"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETingredients"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETingredients" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETingredients">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETingredients" data-method="GET"
      data-path="ingredients"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETingredients', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETingredients"
                    onclick="tryItOut('GETingredients');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETingredients"
                    onclick="cancelTryOut('GETingredients');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETingredients"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>ingredients</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETingredients"
               value="Basic Entrez vos identifiants"
               data-component="header">
    <br>
<p>Example: <code>Basic Entrez vos identifiants</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETingredients"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETingredients"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="ingredients-POSTingredients">POST ingredients</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTingredients">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/ingredients" \
    --header "Authorization: Basic Entrez vos identifiants" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"label\": \"Courgette\",
    \"connected_scale_id\": 16,
    \"place_type_id\": 1,
    \"measurement_unit_id\": 1,
    \"max_quantity\": \"1000\",
    \"is_connected\": false
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/ingredients"
);

const headers = {
    "Authorization": "Basic Entrez vos identifiants",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "label": "Courgette",
    "connected_scale_id": 16,
    "place_type_id": 1,
    "measurement_unit_id": 1,
    "max_quantity": "1000",
    "is_connected": false
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTingredients">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">success {
 &quot;status&quot;: &quot;success&quot;,
 &quot;message&quot;: &quot;Ingr&eacute;dient cr&eacute;&eacute; avec succ&egrave;s&quot;,
 &quot;data&quot;: {
   &quot;id&quot;: 5,
   &quot;label&quot;: &quot;Courgette&quot;,
   &quot;quantity&quot;: 0,
   &quot;max_quantity&quot;: 1000,
   &quot;mesure&quot;: &quot;Grammes&quot;
 }
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">validation_error {
 &quot;message&quot;: &quot;The given data was invalid.&quot;,
 &quot;errors&quot;: {
   &quot;label&quot;: [&quot;Le champ label est obligatoire.&quot;],
   &quot;place_type_id&quot;: [&quot;Le champ place_type_id doit &ecirc;tre un identifiant existant dans la table place_types.&quot;]
 }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTingredients" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTingredients"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTingredients"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTingredients" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTingredients">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTingredients" data-method="POST"
      data-path="ingredients"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTingredients', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTingredients"
                    onclick="tryItOut('POSTingredients');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTingredients"
                    onclick="cancelTryOut('POSTingredients');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTingredients"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>ingredients</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="POSTingredients"
               value="Basic Entrez vos identifiants"
               data-component="header">
    <br>
<p>Example: <code>Basic Entrez vos identifiants</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTingredients"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTingredients"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>label</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="label"                data-endpoint="POSTingredients"
               value="Courgette"
               data-component="body">
    <br>
<p>Le nom de l'ingrédient. Example: <code>Courgette</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>connected_scale_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="number" style="display: none"
               step="any"               name="connected_scale_id"                data-endpoint="POSTingredients"
               value="16"
               data-component="body">
    <br>
<p>The <code>id</code> of an existing record in the connected_scales table. Example: <code>16</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>place_type_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="place_type_id"                data-endpoint="POSTingredients"
               value="1"
               data-component="body">
    <br>
<p>L'identifiant du type de lieu. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>measurement_unit_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="measurement_unit_id"                data-endpoint="POSTingredients"
               value="1"
               data-component="body">
    <br>
<p>L'identifiant de l'unité de mesure. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>max_quantity</code></b>&nbsp;&nbsp;
<small>numeric</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="max_quantity"                data-endpoint="POSTingredients"
               value="1000"
               data-component="body">
    <br>
<p>La quantité maximale de l'ingrédient. Example: <code>1000</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>is_connected</code></b>&nbsp;&nbsp;
<small>boolean</small>&nbsp;
<i>optional</i> &nbsp;
                <label data-endpoint="POSTingredients" style="display: none">
            <input type="radio" name="is_connected"
                   value="true"
                   data-endpoint="POSTingredients"
                   data-component="body"             >
            <code>true</code>
        </label>
        <label data-endpoint="POSTingredients" style="display: none">
            <input type="radio" name="is_connected"
                   value="false"
                   data-endpoint="POSTingredients"
                   data-component="body"             >
            <code>false</code>
        </label>
    <br>
<p>Indique si l'ingrédient est connecté à un capteur. Example: <code>false</code></p>
        </div>
        </form>

                    <h2 id="ingredients-GETingredients-by-type">GET ingredients/by-type</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETingredients-by-type">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/ingredients/by-type" \
    --header "Authorization: Basic Entrez vos identifiants" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/ingredients/by-type"
);

const headers = {
    "Authorization": "Basic Entrez vos identifiants",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETingredients-by-type">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">success {
 &quot;L&eacute;gumes&quot;: {
   &quot;items&quot;: [
     {
       &quot;id&quot;: 1,
       &quot;label&quot;: &quot;Tomate&quot;,
       &quot;quantity&quot;: 500,
       &quot;max_quantity&quot;: 1000,
       &quot;mesure&quot;: &quot;Grammes&quot;
     }
   ]
 },
 &quot;Viandes&quot;: {
   &quot;items&quot;: [
     {
       &quot;id&quot;: 3,
       &quot;label&quot;: &quot;Steack&quot;,
       &quot;quantity&quot;: 1000,
       &quot;max_quantity&quot;: 2000,
       &quot;mesure&quot;: &quot;Grammes&quot;
     }
   ]
 }
}</code>
 </pre>
    </span>
<span id="execution-results-GETingredients-by-type" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETingredients-by-type"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETingredients-by-type"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETingredients-by-type" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETingredients-by-type">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETingredients-by-type" data-method="GET"
      data-path="ingredients/by-type"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETingredients-by-type', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETingredients-by-type"
                    onclick="tryItOut('GETingredients-by-type');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETingredients-by-type"
                    onclick="cancelTryOut('GETingredients-by-type');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETingredients-by-type"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>ingredients/by-type</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETingredients-by-type"
               value="Basic Entrez vos identifiants"
               data-component="header">
    <br>
<p>Example: <code>Basic Entrez vos identifiants</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETingredients-by-type"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETingredients-by-type"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="ingredients-GETingredients-low-stock">GET ingredients/low-stock</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETingredients-low-stock">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/ingredients/low-stock" \
    --header "Authorization: Basic Entrez vos identifiants" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/ingredients/low-stock"
);

const headers = {
    "Authorization": "Basic Entrez vos identifiants",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETingredients-low-stock">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">success {
 &quot;status&quot;: &quot;success&quot;,
 &quot;data&quot;: [
   {
     &quot;id&quot;: 2,
     &quot;label&quot;: &quot;Poulet&quot;,
     &quot;quantity&quot;: 0,
     &quot;max_quantity&quot;: 2000,
     &quot;mesure&quot;: &quot;Grammes&quot;
   },
   {
     &quot;id&quot;: 5,
     &quot;label&quot;: &quot;Cr&egrave;me fra&icirc;che&quot;,
     &quot;quantity&quot;: 250,
     &quot;max_quantity&quot;: 600,
     &quot;mesure&quot;: &quot;Grammes&quot;
   }
 ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETingredients-low-stock" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETingredients-low-stock"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETingredients-low-stock"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETingredients-low-stock" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETingredients-low-stock">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETingredients-low-stock" data-method="GET"
      data-path="ingredients/low-stock"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETingredients-low-stock', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETingredients-low-stock"
                    onclick="tryItOut('GETingredients-low-stock');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETingredients-low-stock"
                    onclick="cancelTryOut('GETingredients-low-stock');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETingredients-low-stock"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>ingredients/low-stock</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETingredients-low-stock"
               value="Basic Entrez vos identifiants"
               data-component="header">
    <br>
<p>Example: <code>Basic Entrez vos identifiants</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETingredients-low-stock"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETingredients-low-stock"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="ingredients-GETingredients-connected">GET ingredients/connected</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETingredients-connected">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/ingredients/connected" \
    --header "Authorization: Basic Entrez vos identifiants" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/ingredients/connected"
);

const headers = {
    "Authorization": "Basic Entrez vos identifiants",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETingredients-connected">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">success {
 &quot;status&quot;: &quot;success&quot;,
 &quot;data&quot;: [
   {
     &quot;id&quot;: 7,
     &quot;label&quot;: &quot;Lait&quot;,
     &quot;quantity&quot;: 800,
     &quot;max_quantity&quot;: 1000,
     &quot;mesure&quot;: &quot;Millilitres&quot;
   },
   {
     &quot;id&quot;: 8,
     &quot;label&quot;: &quot;Farine&quot;,
     &quot;quantity&quot;: 1200,
     &quot;max_quantity&quot;: 2000,
     &quot;mesure&quot;: &quot;Grammes&quot;
   }
 ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETingredients-connected" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETingredients-connected"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETingredients-connected"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETingredients-connected" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETingredients-connected">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETingredients-connected" data-method="GET"
      data-path="ingredients/connected"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETingredients-connected', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETingredients-connected"
                    onclick="tryItOut('GETingredients-connected');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETingredients-connected"
                    onclick="cancelTryOut('GETingredients-connected');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETingredients-connected"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>ingredients/connected</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETingredients-connected"
               value="Basic Entrez vos identifiants"
               data-component="header">
    <br>
<p>Example: <code>Basic Entrez vos identifiants</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETingredients-connected"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETingredients-connected"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="ingredients-DELETEingredients-batch">DELETE ingredients/batch</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEingredients-batch">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/ingredients/batch" \
    --header "Authorization: Basic Entrez vos identifiants" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"ids\": [
        1,
        2,
        3
    ]
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/ingredients/batch"
);

const headers = {
    "Authorization": "Basic Entrez vos identifiants",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "ids": [
        1,
        2,
        3
    ]
};

fetch(url, {
    method: "DELETE",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEingredients-batch">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">success {
 &quot;status&quot;: &quot;success&quot;,
 &quot;message&quot;: &quot;3 ingr&eacute;dient(s) supprim&eacute;(s) avec succ&egrave;s&quot;,
 &quot;count&quot;: 3
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">validation_error {
 &quot;message&quot;: &quot;The given data was invalid.&quot;,
 &quot;errors&quot;: {
   &quot;ids&quot;: [&quot;Le champ ids est obligatoire.&quot;],
   &quot;ids.0&quot;: [&quot;L&#039;&eacute;l&eacute;ment s&eacute;lectionn&eacute; dans ids.0 est invalide.&quot;]
 }
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEingredients-batch" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEingredients-batch"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEingredients-batch"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEingredients-batch" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEingredients-batch">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEingredients-batch" data-method="DELETE"
      data-path="ingredients/batch"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEingredients-batch', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEingredients-batch"
                    onclick="tryItOut('DELETEingredients-batch');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEingredients-batch"
                    onclick="cancelTryOut('DELETEingredients-batch');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEingredients-batch"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>ingredients/batch</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEingredients-batch"
               value="Basic Entrez vos identifiants"
               data-component="header">
    <br>
<p>Example: <code>Basic Entrez vos identifiants</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEingredients-batch"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEingredients-batch"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>ids</code></b>&nbsp;&nbsp;
<small>string[]</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="ids[0]"                data-endpoint="DELETEingredients-batch"
               data-component="body">
        <input type="text" style="display: none"
               name="ids[1]"                data-endpoint="DELETEingredients-batch"
               data-component="body">
    <br>
<p>Tableau des identifiants d'ingrédients à supprimer.</p>
        </div>
        </form>

                    <h2 id="ingredients-DELETEingredients--id-">DELETE ingredients/{id}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEingredients--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/ingredients/1" \
    --header "Authorization: Basic Entrez vos identifiants" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/ingredients/1"
);

const headers = {
    "Authorization": "Basic Entrez vos identifiants",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEingredients--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">success {
 &quot;message&quot;: &quot;Ingr&eacute;dient supprim&eacute; avec succ&egrave;s&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">not_found {
 &quot;message&quot;: &quot;Ingr&eacute;dient non trouv&eacute;&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEingredients--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEingredients--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEingredients--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEingredients--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEingredients--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEingredients--id-" data-method="DELETE"
      data-path="ingredients/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEingredients--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEingredients--id-"
                    onclick="tryItOut('DELETEingredients--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEingredients--id-"
                    onclick="cancelTryOut('DELETEingredients--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEingredients--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>ingredients/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="DELETEingredients--id-"
               value="Basic Entrez vos identifiants"
               data-component="header">
    <br>
<p>Example: <code>Basic Entrez vos identifiants</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEingredients--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEingredients--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="DELETEingredients--id-"
               value="1"
               data-component="url">
    <br>
<p>L'identifiant de l'ingrédient à supprimer. Example: <code>1</code></p>
            </div>
                    </form>

                    <h2 id="ingredients-PATCHingredients--id--quantity">PATCH ingredients/{id}/quantity</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PATCHingredients--id--quantity">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PATCH \
    "http://localhost/ingredients/1/quantity" \
    --header "Authorization: Basic Entrez vos identifiants" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"quantity\": \"500\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/ingredients/1/quantity"
);

const headers = {
    "Authorization": "Basic Entrez vos identifiants",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "quantity": "500"
};

fetch(url, {
    method: "PATCH",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PATCHingredients--id--quantity">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">success {
 &quot;status&quot;: &quot;success&quot;,
 &quot;message&quot;: &quot;Quantit&eacute; mise &agrave; jour avec succ&egrave;s&quot;,
 &quot;data&quot;: {
   &quot;id&quot;: 1,
   &quot;label&quot;: &quot;Tomate&quot;,
   &quot;quantity&quot;: 500,
   &quot;max_quantity&quot;: 1000,
   &quot;mesure&quot;: &quot;Grammes&quot;
 }
}</code>
 </pre>
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">not_found {
 &quot;message&quot;: &quot;Ingr&eacute;dient non trouv&eacute;&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-PATCHingredients--id--quantity" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PATCHingredients--id--quantity"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PATCHingredients--id--quantity"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PATCHingredients--id--quantity" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PATCHingredients--id--quantity">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PATCHingredients--id--quantity" data-method="PATCH"
      data-path="ingredients/{id}/quantity"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PATCHingredients--id--quantity', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PATCHingredients--id--quantity"
                    onclick="tryItOut('PATCHingredients--id--quantity');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PATCHingredients--id--quantity"
                    onclick="cancelTryOut('PATCHingredients--id--quantity');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PATCHingredients--id--quantity"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-purple">PATCH</small>
            <b><code>ingredients/{id}/quantity</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="PATCHingredients--id--quantity"
               value="Basic Entrez vos identifiants"
               data-component="header">
    <br>
<p>Example: <code>Basic Entrez vos identifiants</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PATCHingredients--id--quantity"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PATCHingredients--id--quantity"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="id"                data-endpoint="PATCHingredients--id--quantity"
               value="1"
               data-component="url">
    <br>
<p>L'identifiant de l'ingrédient à modifier. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>quantity</code></b>&nbsp;&nbsp;
<small>numeric</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="quantity"                data-endpoint="PATCHingredients--id--quantity"
               value="500"
               data-component="body">
    <br>
<p>La nouvelle quantité de l'ingrédient. Example: <code>500</code></p>
        </div>
        </form>

                <h1 id="measurementunits">MeasurementUnits</h1>

    

                                <h2 id="measurementunits-GETmeasurement-units">GET measurement-units</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETmeasurement-units">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/measurement-units" \
    --header "Authorization: Basic Entrez vos identifiants" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/measurement-units"
);

const headers = {
    "Authorization": "Basic Entrez vos identifiants",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETmeasurement-units">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">success {
 &quot;status&quot;: &quot;success&quot;,
 &quot;data&quot;: [
   {
     &quot;id&quot;: 1,
     &quot;name&quot;: &quot;Grammes&quot;,
     &quot;symbol&quot;: &quot;g&quot;
   },
   {
     &quot;id&quot;: 2,
     &quot;name&quot;: &quot;Millilitres&quot;,
     &quot;symbol&quot;: &quot;ml&quot;
   },
   {
     &quot;id&quot;: 3,
     &quot;name&quot;: &quot;Unit&eacute;s&quot;,
     &quot;symbol&quot;: &quot;u&quot;
   }
 ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETmeasurement-units" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETmeasurement-units"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETmeasurement-units"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETmeasurement-units" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETmeasurement-units">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETmeasurement-units" data-method="GET"
      data-path="measurement-units"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETmeasurement-units', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETmeasurement-units"
                    onclick="tryItOut('GETmeasurement-units');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETmeasurement-units"
                    onclick="cancelTryOut('GETmeasurement-units');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETmeasurement-units"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>measurement-units</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETmeasurement-units"
               value="Basic Entrez vos identifiants"
               data-component="header">
    <br>
<p>Example: <code>Basic Entrez vos identifiants</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETmeasurement-units"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETmeasurement-units"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="placetypes">PlaceTypes</h1>

    

                                <h2 id="placetypes-GETplace-types">GET place-types</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETplace-types">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/place-types" \
    --header "Authorization: Basic Entrez vos identifiants" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/place-types"
);

const headers = {
    "Authorization": "Basic Entrez vos identifiants",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETplace-types">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">success {
 &quot;status&quot;: &quot;success&quot;,
 &quot;data&quot;: [
   {
     &quot;id&quot;: 1,
     &quot;name&quot;: &quot;Placard&quot;
   },
   {
     &quot;id&quot;: 2,
     &quot;name&quot;: &quot;Frigo&quot;
   },
   {
     &quot;id&quot;: 3,
     &quot;name&quot;: &quot;Cong&eacute;lateur&quot;
   }
 ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETplace-types" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETplace-types"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETplace-types"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETplace-types" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETplace-types">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETplace-types" data-method="GET"
      data-path="place-types"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETplace-types', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETplace-types"
                    onclick="tryItOut('GETplace-types');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETplace-types"
                    onclick="cancelTryOut('GETplace-types');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETplace-types"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>place-types</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETplace-types"
               value="Basic Entrez vos identifiants"
               data-component="header">
    <br>
<p>Example: <code>Basic Entrez vos identifiants</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETplace-types"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETplace-types"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="tempo">tempo</h1>

    

                                <h2 id="tempo-GETup">GET up</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETup">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/up" \
    --header "Authorization: Basic Entrez vos identifiants" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/up"
);

const headers = {
    "Authorization": "Basic Entrez vos identifiants",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETup">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
access-control-allow-methods: GET, POST, PUT, DELETE, PATCH, OPTIONS
access-control-allow-headers: Content-Type, Authorization, X-Requested-With
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">&lt;!DOCTYPE html&gt;
&lt;html lang=&quot;en&quot;&gt;
&lt;head&gt;
    &lt;meta charset=&quot;utf-8&quot;&gt;
    &lt;meta name=&quot;viewport&quot; content=&quot;width=device-width, initial-scale=1&quot;&gt;

    &lt;title&gt;Laravel&lt;/title&gt;

    &lt;!-- Fonts --&gt;
    &lt;link rel=&quot;preconnect&quot; href=&quot;https://fonts.bunny.net&quot;&gt;
    &lt;link href=&quot;https://fonts.bunny.net/css?family=figtree:400,600&amp;display=swap&quot; rel=&quot;stylesheet&quot; /&gt;

    &lt;!-- Styles --&gt;
    &lt;script src=&quot;https://cdn.tailwindcss.com&quot;&gt;&lt;/script&gt;

    &lt;script&gt;
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: [&#039;Figtree&#039;, &#039;ui-sans-serif&#039;, &#039;system-ui&#039;, &#039;sans-serif&#039;, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;],
                    }
                }
            }
        }
    &lt;/script&gt;
&lt;/head&gt;
&lt;body class=&quot;antialiased&quot;&gt;
&lt;div class=&quot;relative flex justify-center items-center min-h-screen bg-gray-100 selection:bg-red-500 selection:text-white&quot;&gt;
    &lt;div class=&quot;w-full sm:w-3/4 xl:w-1/2 mx-auto p-6&quot;&gt;
        &lt;div class=&quot;px-6 py-4 bg-white from-gray-700/50 via-transparent rounded-lg shadow-2xl shadow-gray-500/20 flex items-center focus:outline focus:outline-2 focus:outline-red-500&quot;&gt;
            &lt;div class=&quot;relative flex h-3 w-3 group &quot;&gt;
                &lt;span class=&quot;animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 group-[.status-down]:bg-red-600 opacity-75&quot;&gt;&lt;/span&gt;
                &lt;span class=&quot;relative inline-flex rounded-full h-3 w-3 bg-green-400 group-[.status-down]:bg-red-600&quot;&gt;&lt;/span&gt;
            &lt;/div&gt;

            &lt;div class=&quot;ml-6&quot;&gt;
                &lt;h2 class=&quot;text-xl font-semibold text-gray-900&quot;&gt;Application up&lt;/h2&gt;

                &lt;p class=&quot;mt-2 text-gray-500 dark:text-gray-400 text-sm leading-relaxed&quot;&gt;
                    HTTP request received.

                                            Response rendered in 469ms.
                                    &lt;/p&gt;
            &lt;/div&gt;
        &lt;/div&gt;
    &lt;/div&gt;
&lt;/div&gt;
&lt;/body&gt;
&lt;/html&gt;
</code>
 </pre>
    </span>
<span id="execution-results-GETup" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETup"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETup"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETup" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETup">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETup" data-method="GET"
      data-path="up"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETup', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETup"
                    onclick="tryItOut('GETup');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETup"
                    onclick="cancelTryOut('GETup');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETup"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>up</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETup"
               value="Basic Entrez vos identifiants"
               data-component="header">
    <br>
<p>Example: <code>Basic Entrez vos identifiants</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETup"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETup"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="tempo-GETstorage--path-">GET storage/{path}</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETstorage--path-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/storage/|{+-0p" \
    --header "Authorization: Basic Entrez vos identifiants" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/storage/|{+-0p"
);

const headers = {
    "Authorization": "Basic Entrez vos identifiants",
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETstorage--path-">
            <blockquote>
            <p>Example response (404):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
access-control-allow-methods: GET, POST, PUT, DELETE, PATCH, OPTIONS
access-control-allow-headers: Content-Type, Authorization, X-Requested-With
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETstorage--path-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETstorage--path-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETstorage--path-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETstorage--path-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETstorage--path-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETstorage--path-" data-method="GET"
      data-path="storage/{path}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETstorage--path-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETstorage--path-"
                    onclick="tryItOut('GETstorage--path-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETstorage--path-"
                    onclick="cancelTryOut('GETstorage--path-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETstorage--path-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>storage/{path}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETstorage--path-"
               value="Basic Entrez vos identifiants"
               data-component="header">
    <br>
<p>Example: <code>Basic Entrez vos identifiants</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETstorage--path-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETstorage--path-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>path</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="path"                data-endpoint="GETstorage--path-"
               value="|{+-0p"
               data-component="url">
    <br>
<p>Example: <code>|{+-0p</code></p>
            </div>
                    </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
