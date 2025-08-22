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
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.2.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.2.0.js") }}"></script>

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
                    <ul id="tocify-header-ingredients" class="tocify-header">
                <li class="tocify-item level-1" data-unique="ingredients">
                    <a href="#ingredients">Ingredients</a>
                </li>
                                    <ul id="tocify-subheader-ingredients" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="ingredients-GETingredients">
                                <a href="#ingredients-GETingredients">GET ingredients</a>
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
                                                                                <li class="tocify-item level-2" data-unique="ingredients-POSTingredients">
                                <a href="#ingredients-POSTingredients">POST ingredients</a>
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
                    <ul id="tocify-header-mesures" class="tocify-header">
                <li class="tocify-item level-1" data-unique="mesures">
                    <a href="#mesures">Mesures</a>
                </li>
                                    <ul id="tocify-subheader-mesures" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="mesures-GETmeasures">
                                <a href="#mesures-GETmeasures">GET measures</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-types" class="tocify-header">
                <li class="tocify-item level-1" data-unique="types">
                    <a href="#types">Types</a>
                </li>
                                    <ul id="tocify-subheader-types" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="types-GETtypes">
                                <a href="#types-GETtypes">GET types</a>
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
        <li>Last updated: May 10, 2025</li>
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
    \"balance_id\": \"n\",
    \"type_id\": 1,
    \"measure_id\": 1,
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
    "balance_id": "n",
    "type_id": 1,
    "measure_id": 1,
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
   &quot;type_id&quot;: [&quot;Le champ type_id doit &ecirc;tre un identifiant existant dans la table types.&quot;]
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
            <b style="line-height: 2;"><code>balance_id</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
                <input type="text" style="display: none"
                              name="balance_id"                data-endpoint="POSTingredients"
               value="n"
               data-component="body">
    <br>
<p>validation.max. Example: <code>n</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>type_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="type_id"                data-endpoint="POSTingredients"
               value="1"
               data-component="body">
    <br>
<p>L'identifiant du type d'ingrédient. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>measure_id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="measure_id"                data-endpoint="POSTingredients"
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

                <h1 id="mesures">Mesures</h1>

    

                                <h2 id="mesures-GETmeasures">GET measures</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETmeasures">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/measures" \
    --header "Authorization: Basic Entrez vos identifiants" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/measures"
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

<span id="example-responses-GETmeasures">
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
<span id="execution-results-GETmeasures" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETmeasures"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETmeasures"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETmeasures" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETmeasures">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETmeasures" data-method="GET"
      data-path="measures"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETmeasures', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETmeasures"
                    onclick="tryItOut('GETmeasures');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETmeasures"
                    onclick="cancelTryOut('GETmeasures');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETmeasures"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>measures</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETmeasures"
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
                              name="Content-Type"                data-endpoint="GETmeasures"
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
                              name="Accept"                data-endpoint="GETmeasures"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="types">Types</h1>

    

                                <h2 id="types-GETtypes">GET types</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETtypes">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/types" \
    --header "Authorization: Basic Entrez vos identifiants" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/types"
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

<span id="example-responses-GETtypes">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">success {
 &quot;status&quot;: &quot;success&quot;,
 &quot;data&quot;: [
   {
     &quot;id&quot;: 1,
     &quot;name&quot;: &quot;L&eacute;gumes&quot;
   },
   {
     &quot;id&quot;: 2,
     &quot;name&quot;: &quot;Viandes&quot;
   },
   {
     &quot;id&quot;: 3,
     &quot;name&quot;: &quot;Fruits&quot;
   }
 ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETtypes" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETtypes"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETtypes"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETtypes" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETtypes">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETtypes" data-method="GET"
      data-path="types"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETtypes', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETtypes"
                    onclick="tryItOut('GETtypes');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETtypes"
                    onclick="cancelTryOut('GETtypes');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETtypes"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>types</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Authorization</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Authorization" class="auth-value"               data-endpoint="GETtypes"
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
                              name="Content-Type"                data-endpoint="GETtypes"
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
                              name="Accept"                data-endpoint="GETtypes"
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

                                            Response rendered in 370ms.
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
