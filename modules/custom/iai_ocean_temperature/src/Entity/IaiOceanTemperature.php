<?php

namespace Drupal\iai_ocean_temperature\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\iai_ocean_temperature\IaiOceanTemperatureInterface;

/******************************************************************************
 **                                                                          **
 ** For more details on how we define our content entity                     **
 ** @see: https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Entity%21entity.api.php/group/entity_api/8.5.x **
 **       https://www.drupal.org/docs/8/api/entity-api/introduction-to-entity-api-in-drupal-8 **
 **       https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Entity%21EntityType.php/class/EntityType/8.5.x **
 **                                                                          **
 ** Here are some details about some of the choices we have made:            **
 ** translatable = TRUE                                                      **
 **   We want it to be possible to translate the fields in the data records. **
 **   For instance, we want to be able to express the depth and the          **
 **   temperature in different units of measure.                             **
 ** base_table, data_table                                                   **
 **   Because we have made our entity translatable Drupal will use two       **
 **   tables. We will use the default table names:                           **
 **   iai_ocean_temperature and iai_ocean_temperature_field_data             **
 **   If we had not made our entity translatable Drupal would have put       **
 **   everything in a single table: iai_ocean_temperature.                   **
 **   The User entity makes use of these attributes so that it may specify   **
 **   a different name for the two tables.                                   **
 **   @see: core/modules/user/src/Entity/User                                **
 ** fieldable = FALSE                                                        **
 **   We have decided that we want to maintain strict control over this      **
 **   entity and not allow people to add fields to it through the user       **
 **   interface. (Note: If we wanted it to be fieldable we would have had to **
 **   add the field_ui_base_route attribute in the annotation.)              **
 **                                                                          **
 ******************************************************************************/

/**
 * Defines the IAI Ocean Temperature entity.
 *
 * @ContentEntityType(
 *   id = "iai_ocean_temperature",
 *   label = @Translation("IAI Ocean Temperature Data"),
 *   handlers = {
 *     "access" = "Drupal\iai_ocean_temperature\IaiOceanTemperatureAccessControlHandler",
 *     "form" = {
 *       "default" = "Drupal\iai_ocean_temperature\Form\IaiOceanTemperatureForm",
 *       "delete" = "Drupal\iai_ocean_temperature\Form\IaiOceanTemperatureDeleteForm",
 *     },
 *     "list_builder" = "Drupal\iai_ocean_temperature\Entity\Controller\IaiOceanTemperatureListBuilder",
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "views_data" = "Drupal\iai_ocean_temperature\IaiOceanTemperatureViewsData"
 *   },
 *   translatable = TRUE,
 *   base_table = "iai_ocean_temperature",
 *   data_table = "iai_ocean_temperature_field_data",
 *   fieldable = FALSE,
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "langcode" = "langcode"
 *   },
 *   links = {
 *     "canonical" = "/iai_ocean_temperature/{iai_ocean_temperature}",
 *     "edit-form" = "/iai_ocean_temperature/{iai_ocean_temperature}/edit",
 *     "delete-form" = "/iai_ocean_temperature/{iai_ocean_temperature}/delete",
 *     "collection" = "/iai_ocean_temperature/list"
 *   },
 *   list_cache_contexts = {"user"}
 * )
 */
class IaiOceanTemperature extends ContentEntityBase implements IaiOceanTemperatureInterface {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public function getLabel() {
    return $this->get('label')->value;
  }

/******************************************************************************
 **                                                                          **
 ** Look at the IaiOceanTemperatureInterface to figure out what else you are **
 ** supposed to be adding here.                                              **
 **                                                                          **
 ******************************************************************************/

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {

/******************************************************************************
 **                                                                          **
 ** We start out by retrieving the base field definitions from               **
 ** ContentEntityBase. Since we've used the "id" and "langcode" attributes   **
 ** in entity_keys, these two fields will be defined for us.                 **
 ** @see: core/lib/Drupal/Core/Entity/ContentEntityBase                      **
 **                                                                          **
 ******************************************************************************/
    $fields = parent::baseFieldDefinitions($entity_type);

/******************************************************************************
 **                                                                          **
 ** We define the rest of the fields for our entity below.                   **
 ** @see: https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Field%21BaseFieldDefinition.php/class/BaseFieldDefinition/8.5.x **
 **                                                                          **
 ** For the definitions of possible field types                              **
 ** @see: core/lib/Drupal/Core/Field/Plugin/Field/FieldType                  **
 ** We are choosing to use the default_widget and default_formatter as       **
 ** specified by the field types.                                            **
 **                                                                          **
 ** We must at least set the 'weight' attribute display option.              **
 ** @see: https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Field%21BaseFieldDefinition.php/function/BaseFieldDefinition%3A%3AsetDisplayOptions/8.5.x **
 **                                                                          **
 ** If we wanted to use a different formatter we could specify the 'type'    **
 ** attribute for the display options for 'form'.                            **
 ** @see: core/lib/Drupal/Core/Field/Plugin/Field/FieldFormatter             **
 **                                                                          **
 ** If we wanted to use a different widget we could specify the 'type'       **
 ** attribute for the display options for 'view'.                            **
 ** @see: core/lib/Drupal/Core/Field/Plugin/Field/FieldWidget                **
 **                                                                          **
 ******************************************************************************/

    $fields['label'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Label'))
      ->setDescription(t('A human readable label used to identify this record'))
      ->setRequired(TRUE)
      ->setTranslatable(TRUE)
      ->setSetting('max_length', 255)
      ->setDisplayOptions('form', [
        'weight' => 1,
      ])
      ->setDisplayOptions('view', [
        'weight' => 1,
      ]);

/******************************************************************************
 **                                                                          **
 ** ot_coordinates is the second field                                       **
 **                                                                          **
 ******************************************************************************/

/******************************************************************************
 **                                                                          **
 ** Since we are running the label and description through t() it's possible **
 ** to specify a different unit of measure in different languages. We don't  **
 ** want to use ->setSetting('suffix', ' ft') because we haven't made the    **
 ** entity fieldable, which means there is no way to translate the suffix.   **
 ** It is still possible to navigate to admin/config/regional/translate to   **
 ** change the label and description.                                        **
 **                                                                          **
 ******************************************************************************/

/******************************************************************************
 **                                                                          **
 ** ot_depth is the third field                                              **
 **                                                                          **
 ******************************************************************************/

/******************************************************************************
 **                                                                          **
 ** We are using the same approach that we used for the depth measurement.   **
 ** The label and description are translatable through                       **
 ** admin/config/regional/translate                                          **
 **                                                                          **
 ******************************************************************************/

/******************************************************************************
 **                                                                          **
 ** ot_temperature is the fourth field                                       **
 **                                                                          **
 ******************************************************************************/

/******************************************************************************
 **                                                                          **
 ** By setting this field to not be translatable we are removing the option  **
 ** to configure it through the interface; it will always be untranslatable. **
 ** We could choose to set it as translatable here and then still choose to  **
 ** not configure it as a translatable field through the interface.          **
 **                                                                          **
 ******************************************************************************/

/******************************************************************************
 **                                                                          **
 ** ot_reported_date is the fifth field                                      **
 **                                                                          **
 ******************************************************************************/
    
/******************************************************************************
 **                                                                          **
 ** For the exercise we are going to set the date to be not translatable.    **
 ** There is a core bug that causes the label for the date to show the span  **
 ** tags.                                                                    **
 ** @see: https://www.drupal.org/node/2914464                                **
 **                                                                          **
 ******************************************************************************/

/******************************************************************************
 **                                                                          **
 ** ot_reporter is the sixth field                                           **
 **                                                                          **
 ******************************************************************************/

    $fields['changed'] = BaseFieldDefinition::create('changed');
    $fields['created'] = BaseFieldDefinition::create('created');

    return $fields;
  }
}
