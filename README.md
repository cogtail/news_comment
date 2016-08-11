# news_comment
<h1>TYPO3 Comments for News System and Powermail</h1>
<h2>Beschreibung der Kommentar-Extension</h2>
news_comment nutzt das PlugIn Powermail_frontend von Powermail, um anstelle eines Gästebuchs eine Kommentar-Extension für TYPO3 und News System (tx_news) anzubieten. Somit stehen grundsätzlich alle Funktionen von Powermail_frontend und Powermail zur Verfügung (z.B. <b>Kommentare freischalten</b>). Weitere Funktionen der Extension: 
<ul><li>Gravatar</li> 
<li>Website (sofern angegeben) wird im Namen des Kommentatoren verlinkt</li>
<li>Kommentar-Counter in der Listenansicht</li></ul>

<h4>News Comments vorbereiten:</h4>
News System (tx_news) mit Powermail verbinden (Konstanten: addQueryString="1"), Formular für Kommentare erstellen (Name, E-Mail, Website, Kommentar, Senden, sowie News Titel und die News ID an das Formular übergeben (s. Link unten))

<h4>Einstellungen im PlugIn Powermail_frontend</h4>
ListView: Choose Fields to show: Name und Kommentar; Gravatar und Verlinkung der Website erfolgen dann automatisch

<h4>Abhängigkeiten:</h4>
<ul><li>TYPO3 7.6 (TYPO3 8-Unterstützung in einigen Tagen)</li>
<li>Powermail 2 (Powermail 3 in einigen Tagen)</li></ul>

<h4>Links: Tutorial von TYPO3-Probleme</h4>
http://www.typo3-probleme.de/2014/07/21/typo3-tx_news-daten-an-powermail-2-x-uebergeben-1366/

<h4>To do-Liste für TYPO3 Comments for News System and Powermail</h4>
<ul>
<li>Auf Kommentare antworten</li>
<li>E-Mail-Notification</li>
<li>Noch leichtere Integration</li>
<li>Bootstrap (aktuell ZURB Foundation)</li>
<li>Demo (kommt in Kürze)</li>
<li>Counter verbessern</li>
</ul>

<h4>Website</h4>
http://www.cogtail.de

