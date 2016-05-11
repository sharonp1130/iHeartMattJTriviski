package help.me.utilities.json;

import java.util.Collection;
import java.util.Map;
import java.util.Set;

import com.fasterxml.jackson.annotation.JsonIgnore;
import com.fasterxml.jackson.annotation.JsonProperty;
import com.fasterxml.jackson.annotation.JsonTypeInfo;
import com.fasterxml.jackson.databind.ObjectMapper;
import com.fasterxml.jackson.databind.SerializationFeature;
import com.fasterxml.jackson.datatype.hibernate5.Hibernate5Module;

import help.me.orm.entity.Info;
import help.me.orm.entity.License;
import help.me.orm.entity.Location;
import help.me.orm.entity.Service;
import help.me.orm.entity.Settings;
import help.me.orm.entity.User;

/*
* Jackson serialization utilities.  Static instances of object mappers configured with the available views are 
* created and cached to be used with any call to the serialization methods. 
* 
* @author triviski
*
*/
public class JsonUtilities {
	/**
	 * Create static instances since they are thread safe and are heavy weight to create every request. The Jackson 
	 * documentation recommends doing this, so we listened.
	 */
	private static final ObjectMapper serializationMapper;
	private static final ObjectMapper requestMapper;
	
	static {
		serializationMapper = createSerializerObjectMapper();
		requestMapper = createRequestObjectMapper();
	}
	
	/**
	 * @return the object mapper configured with the serialization view.
	 */
	public static ObjectMapper getSerializationMapper() {
		return serializationMapper;
	}

	/**
	 * @return the object mapper configured with the request view.
	 */
	public static ObjectMapper getRequestMapper() {
		return requestMapper;
	}
	
	/**
	 * Creates an object mapper.  Sets the default view to viewClass.
	 * @param viewClass
	 * @param disableViewInclusion - If true only properties marked with JsonView will be serialized / deserialized.
	 * @param indentOutput
	 * @param typeInfo - If true will add the mixin for collection and map to include the class information.
	 * 
	 * @return a new object mapper with view viewClass and inclusion and indent options set based on inputs.
	 */
	public static ObjectMapper createMapper(boolean typeInfo, boolean ignoreTransient) {
		ObjectMapper mapper = new ObjectMapper();
		
		if (typeInfo) {
			mapper.addMixIn(Collection.class, IncludeTypeMixin.class);
			mapper.addMixIn(Map.class, IncludeTypeMixin.class);
		}

		mapper.enable(SerializationFeature.INDENT_OUTPUT);
		Hibernate5Module module = new Hibernate5Module();
		
		if (!ignoreTransient) {
			module.disable(Hibernate5Module.Feature.USE_TRANSIENT_ANNOTATION);
		}

		mapper.registerModule(module);
		
		return mapper;
	}
	
	/**
	 * This mixin is used to disable the including the type in the output json.  This is used only
	 * for the request mapper because the json will not and can not be deserialized.
	 * 
	 * @author triviski
	 *
	 */
	@JsonTypeInfo(use = JsonTypeInfo.Id.NONE, include = JsonTypeInfo.As.PROPERTY, property = "@class")
	public abstract class RequestMixIn {}

	/**
	 * Use this mixin to make sure that the type information is included in the serialization for types
	 * such collections or maps, etc.
	 * 
	 * @author triviski
	 *
	 */
	@JsonTypeInfo(use = JsonTypeInfo.Id.CLASS, include = JsonTypeInfo.As.PROPERTY, property = "@class")
	abstract class IncludeTypeMixin {}
	
	/**
	 * @return a new object mapper with view RequestView.
	 */
	public static ObjectMapper createRequestObjectMapper() {
		ObjectMapper mapper = createMapper(false, true);
		return mapper;
	}

	/**
	 * @return a new object mapper with view SerializationView and indent on.
	 */
	public static ObjectMapper createSerializerObjectMapper() {
		ObjectMapper mapper = createMapper(true, true);
		
		return mapper;
	}
	
	/**
	 * This mixin class is used for the user query object mapper.  The purpose 
	 * is to allow the user class to be serialized into json with all of the 
	 * linked objects only when quering for providers.  Otherwise just 
	 * the specific user fields will be returned for other calls.
	 * 
	 * Note, this does not include any locations.
	 * 
	 * @author triviski
	 *
	 */
	abstract class UserMixin {
		@JsonProperty("info")
		public abstract Info getInfo();

		@JsonProperty("availability")
		public abstract Settings getSettings();

		@JsonProperty("licenses")
		public abstract Set<License> getLicenses();

		@JsonProperty("location")
		public abstract Location getLastLocation();
	}

	abstract class LicenseMixin {
		@JsonIgnore
		public abstract Service getService();

		@JsonProperty
		public abstract String getServiceDescription(); 
	}

	abstract class ServiceMixin {
		@JsonProperty("description")
		public abstract String getDescription();
		
		@JsonIgnore
		private String iconFileName;
	}

	public static ObjectMapper createUserObjectMapper() {
		ObjectMapper mapper = createMapper(false, false);
		
		// Add the mixin to include all of the mapped classes.
		mapper.addMixIn(User.class, UserMixin.class)
			  .addMixIn(License.class, LicenseMixin.class)
			  ;
		return mapper;
	}
	
}