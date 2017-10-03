<?php

namespace Drupal\iai_ocean_temperature;

use Drupal\views\EntityViewsData;

/******************************************************************************
 **                                                                          **
 ** To understand how to write this class                                    **
 ** @see: https://api.drupal.org/api/drupal/core%21modules%21views%21views.api.php/function/hook_views_data/8.5.x  **
 **                                                                          **
 ******************************************************************************/

/**
 * Provides the Views data for the IAI Ocean Temperature entity.
 */
class IaiOceanTemperatureViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['iai_ocean_temperature']['table']['group'] = $this->t('IAI Ocean Temperature Table');
    $data['iai_ocean_temperature']['table']['base'] = [
      'field' => 'id',
      'title' => $this->t('IAI Ocean Temperature'),
      'help' => $this->t('This data is reported via a RESTful interface and is also programatically and manually translated'),
    ];

/******************************************************************************
 **                                                                          **
 ** To find the field handlers that Views core understands                   **
 ** @see: https://api.drupal.org/api/drupal/core%21modules%21views%21src%21Plugin%21views%21field%21FieldPluginBase.php/group/views_field_handlers/8.5.x **
 **                                                                          **
 ** To find the argument handlers that Views core understands                **
 ** @see: https://api.drupal.org/api/drupal/core%21modules%21views%21src%21Plugin%21views%21argument%21ArgumentPluginBase.php/group/views_argument_handlers/8.5.x **
 **                                                                          **
 ** To find the filter handlers that Views core understands                  **
 ** @see: https://api.drupal.org/api/drupal/core%21modules%21views%21src%21Plugin%21views%21filter%21FilterPluginBase.php/group/views_filter_handlers/8.5.x **
 **                                                                          **
 ** To find the sort handlers that Views core understands                    **
 ** @see: https://api.drupal.org/api/drupal/core%21modules%21views%21src%21Plugin%21views%21sort%21SortPluginBase.php/group/views_sort_handlers/8.5.x **
 **                                                                          **
 ******************************************************************************/
    $data['iai_ocean_temperature']['id'] = [
      'title' => $this->t('IAI Ocean Temperature ID'),
      'help' => $this->t('A unique ID that is incremented automatically when a row is created'),
      'field' => [
        'id' => 'numeric',
      ],
      'argument' => [
        'id' => 'numeric',
      ],
      'filter' => [
        'id' => 'numeric',
      ],
      'sort' => [
        'id' => 'standard',
      ],
    ];

    $data['iai_ocean_temperature']['label'] = [
      'title' => $this->t('IAI Ocean Temperature Label'),
      'help' => $this->t('The label that was assigned to this record'),
      'field' => [
        'id' => 'standard',
      ],
      'filter' => [
        'id' => 'string',
      ],
      'sort' => [
        'id' => 'standard',
      ],
    ];

/******************************************************************************
 **                                                                          **
 ** ot_coordinates is a string field                                         **
 **                                                                          **
 ******************************************************************************/

/******************************************************************************
 **                                                                          **
 ** ot_depth is a numeric field                                              **
 **                                                                          **
 ******************************************************************************/

/******************************************************************************
 **                                                                          **
 ** ot_temperature is a numeric field                                        **
 **                                                                          **
 ******************************************************************************/

/******************************************************************************
 **                                                                          **
 ** ot_temperature is a timestamp field                                      **
 **                                                                          **
 ******************************************************************************/

/******************************************************************************
 **                                                                          **
 ** ot_reporter is a string field                                            **
 **                                                                          **
 ******************************************************************************/

    return $data;
  }

}
