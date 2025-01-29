<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'content', 'image'];

    public function processContent()
    {
        return $this->replaceShortcodes($this->content);
    }

    protected function replaceShortcodes($content)
    {
        $shortcodes = [
            'current_date' => fn () => now()->format('F d, Y'),
            'site_name' => fn () => config('app.name'),
            'dynamic_list' => fn () => $this->getDynamicList(),
            'contact_form' => fn () => $this->getContactForm(),
            'newsletter_form' => fn () => $this->getNewsletterForm(),
            'example_param' => fn ($param) => $this->getExampleParamFromShortcode($param),
        ];

        // Match shortcodes with parameters [[shortcode:param]]
        // Match shortcodes with parameters [shortcode parm1:'value' parm2:'value' ...]
        $content = preg_replace_callback('/\[(\w+)(.*?)\]/', function ($matches) use ($shortcodes) {
            $shortcode = $matches[1];
            $params = $matches[2];

            // Parse parameters in the format: parm1:'value' parm2:'value' ...
            preg_match_all("/(\w+):'([^']+)'/", $params, $paramMatches, PREG_SET_ORDER);

            // Prepare the parameters as an associative array
            $paramsArray = [];
            foreach ($paramMatches as $paramMatch) {
                $paramsArray[$paramMatch[1]] = $paramMatch[2];
            }

            // Call the appropriate shortcode function with the parsed parameters
            return isset($shortcodes[$shortcode]) ? $shortcodes[$shortcode]($paramsArray) : '';
        }, $content);

        return $content;
    }

    protected function getDynamicList()
    {
        $items = ['Item 1', 'Item 2', 'Item 3'];
        return '<ul>' . implode('', array_map(fn($item) => "<li>{$item}</li>", $items)) . '</ul>';
    }

    protected function getContactForm()
    {
        return '
            <form method="POST" action="' .'/vendor/contact-submit'.'" class="contact-form">
                ' . csrf_field() . '
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Send</button>
            </form>
        ';
    }

    protected function getNewsletterForm()
    {
        return '
            <form method="POST" action="' . route('newsletter.submit') . '" class="newsletter-form">
                ' . csrf_field() . '
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <button type="submit" class="btn btn-success">Subscribe</button>
            </form>
        ';
    }

    protected function getExampleParamFromShortcode($params)
            {
                // Extract parameters
                $title = $params['parm1'] ?? '';
                $count = $params['parm2'] ?? '0';
                $list = isset($params['parm3']) ? explode(',', $params['parm3']) : [];

                // Prepare the HTML list
                $htmlList = '<ul>' . implode('', array_map(fn($item) => "<li>{$item}</li>", $list)) . '</ul>';

                return "<div class='example-param'>
                            <h3>{$title}</h3>
                            <p>Count: {$count}</p>
                            {$htmlList}
                        </div>";
            }
}
