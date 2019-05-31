<?php

echo '<div class="readme-header-container">
        <div class="container left-container">
          <h4>Readme</h4>
        </div>
        <div class="upload-readme container right-container">
          <div class="modal fade upload-modal" id="readme-upload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
      aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header text-center">
                  <h4 class="modal-title w-100 font-weight-bold">Readme</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form action="display.php?id='. $id .'" class="form-horizontal" method="post" name="upload_excel" enctype="multipart/form-data">
                    <fieldset>

                        <div class="form-group">
                            <label class="col-md-4 control-label" for="filebutton">Select File</label>
                            <div class="col-md-4">
                                <input type="file" name="file" id="readme-file" class="input-large" accept=".xml,.csv">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-5">
                                <button type="submit" id="submit" name="readme_submit" data-loading-text="Loading...">Submit</button>
                            </div>
                        </div>

                    </fieldset>
                </form>

                </div>
              </div>
            </div>
          </div>

          <div class="text-right">
            <input type="submit" id="tableSubmit" value="Save" name="readme_save_button" form="readme-form" class="btn btn-default btn-rounded mb-4"/>
            <a href="" class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#readme-upload" style="margin:1px 0 0 5px;;">Upload From File</a>
          </div>

        </div>
      </div>

      <div id="wrapper">

        <!-- Top Div -->
        <div id="top-div" class="border-bottom">
          <form name="readme" action="display.php?selection='. $selection. '&id='. $id.'" id="readme-form" method="POST" >
            <input type="hidden" name="id" value="'. $id .'"/>
            <input type="hidden" name="sde_old" value="'. $sde_name .'">
            <li>Common Name <a data-toggle="tooltip" data-placement="top" title="Descriptive name without underscores or abbreviations"><i class="fas fa-info-circle"></i></a></li><li><input type="text" name="common_name" style="width:500px;" value="'. $common_name .'"/></li>
            <br>

            <li>SDE Name <a data-toggle="tooltip" data-placement="top" title="Name of the SDE data set"><i class="fas fa-info-circle"></i></a></li><li><input type="text" name="sde_name" style="width:500px;" value="'. $sde_name .'" required/></li>

            <br>
            <li>Tags for Guide <a data-toggle="tooltip" data-placement="top" title="Enter search terms for the data set. These will be used to find the data set on the Esri HUB. These tags would be used for the guide."><i class="fas fa-info-circle"></i></a></li><li><input type="text" name="tags_guide" style="width:500px;" value="'. $tags_guide .'"/></li>
            <br>
            <li>Tags for SDE <a data-toggle="tooltip" data-placement="top" title="Enter search terms for the data set. These will be used to find the data set on the Esri HUB. These tags would be used for the SDE."><i class="fas fa-info-circle"></i></a></li><li><input type="text" name="tags_sde" style="width:500px;" value="'. $tags_sde .'"/></li>
            <br>
            <li>Summary <a data-toggle="tooltip" data-placement="top" title="One or two line description of the data set"><i class="fas fa-info-circle"></i></a></li><li><textarea name="summary" style="height:90px;width:500px;" >'. $summary .'</textarea></li>
            <br>
            <li>Summary - Update Date <a data-toggle="tooltip" data-placement="top" title="Date the summary was updated"><i class="fas fa-info-circle"></i></a></li><li><input type="text" name="summary_update_date" style="height:40px;width:500px;" value="'. $summary_update_date .'"/></li>
            <br>
            <li>Description <a data-toggle="tooltip" data-placement="top" title="Concise, high level summary of the data set (no more than one or two paragraphs)."><i class="fas fa-info-circle"></i></a></li><li><textarea name="description" style="height:90px;width:500px;"> '. $description .' </textarea></li>
            <br>
            <li>Description - Data Location <a data-toggle="tooltip" data-placement="top" title="Data location of the dataset"><i class="fas fa-info-circle"></i></a></li><li><input type="text" name="description_data_loc" style="width:500px;" value="'. $description_data_loc .'"/></li>
            <br>
            <li>Data Steward <a data-toggle="tooltip" data-placement="top" title="The group or division in DCP that is the business owner for the data set."><i class="fas fa-info-circle"></i></a></li><li><input type="text" name="data_steward" style="width:500px;" value="'. $data_steward .'"/></li>
            <br>
            <li>Data Engineer <a data-toggle="tooltip" data-placement="top" title="The group or division in DCP that is the technical owner for the data set. The data engineer cleans, prepares, and optimizes the data set under the guidance of the data steward."><i class="fas fa-info-circle"></i></a></li><li><input type="text" name="data_engineer" style="width:500px;" value="'. $data_engineer .'"/></li>
            <br>
            <li>Credits <a data-toggle="tooltip" data-placement="top" title="For data sets received from an outside source and not modified by DCP, list the outside source. If DCP added value to the data, list both the outside source and DCP."><i class="fas fa-info-circle"></i></a></li><li><input type="text" name="credits" style="width:500px;" value="'. $credits .'"/></li>
            <br>
            <li>General Constraints Use Limitations <a data-toggle="tooltip" data-placement="top" title="Dataset is being provided by the Department of City Planning (DCP) on DCP\'s website for informational purposes only. DCP does not warranty the completeness, accuracy, content, or fitness for any particular purpose or use of dataset, nor are any such warranties to be implied or inferred with respect to Dataset as furnished on the website."><i class="fas fa-info-circle"></i></a></li><li><textarea name="genconst" style="height:90px;width:500px;" >'. $genconst .'</textarea></li>
            <br>
            <li>Legal Constraints Use Limitations <a data-toggle="tooltip" data-placement="top" title="DCP and the City are not liable for any deficiencies in the completeness, accuracy, content, or fitness for any particular purpose or use of the dataset, or applications utilizing Dataset, provided by any third party."><i class="fas fa-info-circle"></i></a></li><li><textarea name="legconst" style="height:90px;width:500px;" >'. $legconst .'</textarea></li>
            <br>
            <!-- <li>Update Frequency:</li><li><input type="text" name="update_freq" /></li> -->
            <li>Update Frequency <a data-toggle="tooltip" data-placement="top" title="How often will this data set be updated? For data sets with a regular update schedule, this may be Monthly, Quarterly, or Annually. For one-off data sets, such as those created for a particular study, this may be None planned or As needed."><i class="fas fa-info-circle"></i></a></li>
            <select required name="update_freq" id="ddTables" style="font-size:12pt; height:45px; width:500px;">
              <option value="'. $update_freq .'" selected>'. $update_freq .'</option>
              <option value="monthly">Monthly</option>
              <option value="biannually">Biannually</option>
              <option value="annually">Annually</option>
              <option value="quarterly">Quarterly</option>
              <option value="daily">Daily</option>
              <option value="weekly">Weekly</option>
              <option value="fortnightly">Fortnightly</option>
              <option value="as-needed">As Needed</option>
            </select>
            <br>
            <br><li>Date of Last Update <a data-toggle="tooltip" data-placement="top" title="When was the data set last updated? This should be the date that any processing and quality assurance was complete. It is the release date of the data set."><i class="fas fa-info-circle"></i></a></li><li><input type="text" name="date_last_update" style="width:500px;" value="'. $date_last_update .'"/></li>
            <br>
            <li>Date of Underlying Data <a data-toggle="tooltip" data-placement="top" title="The “as of” date for the data. For a data set with multiple sources, like MapPLUTO, list each source and the date the data was extracted or received."><i class="fas fa-info-circle"></i></a></li><li><input type="text" name="date_underlying_data" style="width:500px;" value="'. $date_underlying_data .'"/></li>
            <br>
            <li>Data Sources and Compilation Process <a data-toggle="tooltip" data-placement="top" title="If applicable, include a link to GitHub. Otherwise, describe how the data was sourced and processed."><i class="fas fa-info-circle"></i></a></li><li><textarea name="data_source" style="height:90px;width:500px;" >'. $data_source .'</textarea></li>
            <br>
            <li>Version <a data-toggle="tooltip" data-placement="top" title="If applicable, include the version number, e.g., 17V1 for MapPLUTO"><i class="fas fa-info-circle"></i></a></li><li><input type="text" name="version" style="width:500px;" value="'. $version .'"/></li>
            <br>
            <li>Common Uses <a data-toggle="tooltip" data-placement="top" title="Describe any common applications for the dataset (i.e. soft site or CEQR analyses), including primary users of the dataset."><i class="fas fa-info-circle"></i></a></li><li><textarea name="common_uses" style="height:90px;width:500px;" >'. $common_uses .'</textarea></li>
            <br>
            <li>Data Quality <a data-toggle="tooltip" data-placement="top" title="If known, include information on the overall accuracy and completeness of the data set. (Information on specific fields should be documented in the data dictionary)."><i class="fas fa-info-circle"></i></a></li><li><textarea name="data_quality" style="height:90px;width:500px;">'. $data_quality .'</textarea></li>
            <br>
            <li>Caveats <a data-toggle="tooltip" data-placement="top" title="Outline any pitfalls, potential misconceptions, and/or misuses of the data. This will help users determine if the data set is applicable to their use case and help them avoid using the data incorrectly."><i class="fas fa-info-circle"></i></a></li><li><textarea name="caveats" style="height:90px;width:500px;">'. $caveats .'</textarea></li>
            <br>
            <li>Future Plans <a data-toggle="tooltip" data-placement="top" title="If applicable, describe any enhancements planned for the data set."><i class="fas fa-info-circle"></i></a></li><li><textarea name="future_plans" style="height:90px;width:500px;">'. $future_plans .'</textarea></li>
            <br>
            <li>Distribution <a data-toggle="tooltip" data-placement="top" title="Who is allowed to use this data set? Specific divisions within DCP, all DCP staff, other city agencies, the public?"><i class="fas fa-info-circle"></i></a></li><li><input type="text" name="distribution" style="width:500px;" value="'. $distribution .'"/></li>
            <br>
            <li>Contact <a data-toggle="tooltip" data-placement="top" title="If known, include contact information for the dataset."><i class="fas fa-info-circle"></i></a></li><li><input type="text" name="contact" style="width:500px;" value="'. $contact .'"/></li>
            <br>
            <li>Data Access <a data-toggle="tooltip" data-placement="top" title="The Guide specific, path to layers."><i class="fas fa-info-circle"></i></a></li><li><input type="text" name="data_access" style="width:500px;" value="'. $data_access .'"/></li>
            <br>
            <br>
          </form>
        </div><!-- /Top Div -->';

?>
