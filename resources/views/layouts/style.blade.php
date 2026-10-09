<style>
    /* Black & white theme: white pages, black text, black borders, black buttons. */
    :root { --black: #000; --white: #fff; --grey: #555; --line: #000; }

    * { box-sizing: border-box; }
    body { font-family: Arial, Helvetica, sans-serif; margin: 0; color: var(--black); background: var(--white); }

    header { display: flex; justify-content: space-between; align-items: center; padding: 12px 20px; background: var(--white); border-bottom: 2px solid var(--black); }
    main { max-width: 1000px; margin: 20px auto; padding: 0 20px; }

    section, form.box { background: var(--white); border: 1px solid var(--line); padding: 15px 20px; margin-bottom: 20px; }
    h1, h2, h3 { margin-top: 0; }
    a { color: var(--black); text-decoration: underline; }

    .row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; }

    table { width: 100%; border-collapse: collapse; font-size: 14px; }
    th, td { text-align: left; padding: 8px; border-bottom: 1px solid var(--black); word-break: break-word; }
    th { font-weight: bold; border-bottom: 2px solid var(--black); }

    label { display: block; margin-top: 12px; font-weight: bold; }
    input[type=text], input[type=email], input[type=url], input[type=password], select {
        width: 100%; max-width: 440px; padding: 7px; background: var(--white); color: var(--black); border: 1px solid var(--black);
    }
    input:focus, select:focus { outline: 2px solid var(--black); outline-offset: 1px; }

    button, a.button {
        display: inline-block; padding: 7px 16px; background: var(--black); color: var(--white); border: 1px solid var(--black);
        text-decoration: none; cursor: pointer; font-size: 14px;
    }
    button:hover, a.button:hover { background: var(--white); color: var(--black); }

    .error { color: var(--black); font-size: 13px; font-weight: bold; margin: 4px 0 0; border-left: 3px solid var(--black); padding-left: 8px; }
    .flash { padding: 10px 12px; margin-bottom: 15px; border: 1px solid var(--black); background: var(--white); }
    .flash.info { word-break: break-all; border-style: dashed; }
    .req { font-weight: bold; }
    .muted { color: var(--grey); }

    /* Guest pages (login, accept invitation): title on top, form centred on the screen. */
    body.guest { min-height: 100vh; display: flex; flex-direction: column; }
    .site-title { text-align: center; margin: 0; padding: 18px 20px; border-bottom: 2px solid var(--black); font-size: 24px; }
    .center { flex: 1; display: flex; align-items: center; justify-content: center; padding: 20px; }
    .center-inner { width: 100%; max-width: 480px; }
    .center-inner form.box { margin-bottom: 0; }
</style>
