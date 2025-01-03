# KUSSIN | Google Reviews: Dynamic Badge

Creates a dynamic badge for Google Reviews by fetching the latest reviews from the Google Places API.

**Example:**

![KUSSIN | Google Reviews: Dynamic Badge - Preview](docs/badge/Badge_Preview.svg)

## Installation

Download the latest package from the [GitHub](https://github.com/kussin/GoogleReviewDynamicBadge.git) and upload it to 
your server. - I recommend a separate subdomain for this purpose.

## Configuration

Rename the file `config.inc.php.dist` to `config.inc.php` and adjust the settings to your needs.

### Google Places API Key

To retrieve data using the Google Places API, you need to create an API key in the Google Cloud Console:

1. Log in to the [Google Cloud Console](https://console.cloud.google.com/).
2. Create a new project or select an existing project.
3. Enable the API:
    - Go to **APIs & Services** > **Library**.
    - Search for **Places API** and enable it.
4. Create an API key:
    - Navigate to **APIs & Services** > **Credentials**.
    - Click **Create Credentials** > **API Key**.
    - Restrict the API key (e.g., limit it to the Places API and specific IP addresses or HTTP referrers).


### Google Places ID

To get the Google Places ID, you can use the [Place ID Finder](https://developers.google.com/maps/documentation/javascript/examples/places-placeid-finder)
and enter the name of your business. The Place ID will be displayed in the search results.

## Bugtracker and Feature Requests

Please use the [Github Issues](https://github.com/kussin/GoogleReviewDynamicBadge/issues) for bug reports and feature requests.

## Support

Kussin | eCommerce und Online-Marketing GmbH<br>
Fahltskamp 3<br>
25462 Rellingen<br>
Germany

Fon: +49 (4101) 85868 - 0<br>
Email: info@kussin.de

## Copyright

&copy; 2025 Fuxstar GmbH