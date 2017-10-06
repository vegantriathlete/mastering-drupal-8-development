<?php

namespace Drupal\iai_ocean_temperature\Controller;

use Drupal\Component\Utility\Html;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Connection;
use Drupal\Core\Datetime\DateFormatterInterface;
use Drupal\Core\Language\LanguageManagerInterface;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Displays a table of IAI Ocean Temperature Data
 */
class IaiOceanTemperatureDataListing extends ControllerBase {

  /**
   * A database connection object.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $database;

  /**
   * The currently selected language.
   *
   * @var \Drupal\Core\Language\Language
   */
  protected $currentLanguage;

  /**
   * The date formatter service.
   *
   * @var \Drupal\Core\Datetime\DateFormatterInterface
   */
  protected $dateFormatter;

  /**
   * Constructs the controller
   *
   * @param \Drupal\Core\Database\Connection $database
   *   A database connection object.
   * @param \Drupal\Core\Language\LanguageManagerInterface $language_manager
   *   The language manager.
   * @param \Drupal\Core\Datetime\DateFormatterInterface $date_formatter
   *   The language manager.
   */
  public function __construct(Connection $database, LanguageManagerInterface $language_manager, DateFormatterInterface $date_formatter) {
    $this->database = $database;
    $this->currentLanguage = $language_manager->getCurrentLanguage();
    $this->dateFormatter = $date_formatter;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database'),
      $container->get('language_manager'),
      $container->get('date.formatter')
    );
  }

  /**
   * Builds the sortable table
   */
  public function build() {

    $langcode = $this->currentLanguage->getId();

    $query = $this->database->select('iai_ocean_temperature_field_data', 'ot')
      ->extend('Drupal\Core\Database\Query\TableSortExtender')
      ->extend('Drupal\Core\Database\Query\PagerSelectExtender');
    $query->condition('langcode', $langcode);
    $query->fields('ot', [
      'id',
      'label',
      'ot_coordinates',
      'ot_depth',
      'ot_temperature',
      'ot_reported_date'
    ]);

    $header = [
      ['data' => $this->t('Label'), 'field' => 'label', 'sort' => 'asc'],
      ['data' => $this->t('Coordinates'), 'field' => 'ot_coordinates'],
      ['data' => $this->t('Depth'), 'field' => 'ot_depth'],
      ['data' => $this->t('Temperature'), 'field' => 'ot_temperature'],
      ['data' => $this->t('Reported'), 'field' => 'ot_reported_date']
    ];

    $results = $query
      ->limit(3)
      ->orderByHeader($header)
      ->execute();

    $rows = [];
    foreach ($results as $result) {
      $url = Url::fromRoute('entity.iai_ocean_temperature.canonical', array('iai_ocean_temperature' => $result->id));
      $rows[] = [
        'data' => [
          Link::fromTextAndUrl($result->label, $url)->toString(),
          Html::escape($result->ot_coordinates),
          $result->ot_depth,
          $result->ot_temperature,
          $this->dateFormatter->format($result->ot_reported_date)
        ]
      ];
    }

    $build['entity_list_table'] = [
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $rows,
      '#empty' => $this->t('There are no IAI Ocean Temperature Data rows, yet.'),
    ];

    $build['pager'] = ['#type' => 'pager'];

    return $build;
  }

}
