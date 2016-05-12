package help.me.orm.entity;
// Generated Nov 26, 2015 6:04:16 PM by Hibernate Tools 4.3.1.Final

import java.util.Collection;
import java.util.Comparator;
import java.util.HashSet;
import java.util.Iterator;
import java.util.Set;
import java.util.TreeSet;

import javax.persistence.CascadeType;
import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.FetchType;
import javax.persistence.GeneratedValue;
import javax.persistence.Id;
import javax.persistence.JoinColumn;
import javax.persistence.OneToMany;
import javax.persistence.OneToOne;
import javax.persistence.Table;
import javax.persistence.Transient;
import javax.persistence.UniqueConstraint;

import org.apache.commons.validator.EmailValidator;
import org.hibernate.annotations.GenericGenerator;
import org.hibernate.search.annotations.ContainedIn;
import org.hibernate.search.annotations.IndexedEmbedded;

import com.fasterxml.jackson.annotation.JsonIgnore;
import com.fasterxml.jackson.annotation.JsonProperty;

/**
 * User generated by hbm2java
 */
/**
 * @author triviski
 *
 */
@SuppressWarnings("serial")
@Entity
@Table(name = "user", uniqueConstraints = @UniqueConstraint(columnNames = "email") )
public class User implements java.io.Serializable {
	@JsonProperty("userId")
	private int userId;
	
	@JsonProperty("email")
	private String email;
	@JsonProperty("firstName")
	private String firstName;
	@JsonProperty("lastName")
	private String lastName;
	@JsonProperty("isProvider")
	boolean isProvider;

	/**
	 * info, settings and licenses are not included.  Those are returned independently.
	 */
	@JsonIgnore
	private Settings settings;

	@JsonIgnore
	private Info info;

	@JsonIgnore
    private Set<License> licenses = new HashSet<License>(0);

	@JsonIgnore
	@ContainedIn
	private Set<Location> locations = new HashSet<Location>(0);

	@JsonIgnore
	private Long createdAt;
	@JsonIgnore
	private Long updatedAt;

	// I took this out, no reason to load them all in this entity.
    // private Set<Location> locations = new HashSet<Location>(0);

	/**
	 * 
	 */
	public User() {
	}


    public User(int userId, Info info, Settings settings, String email, String firstName, String lastName,
			boolean isProvider, Set<License> licenses, Long createdAt, Long updatedAt) {
		super();
		this.userId = userId;
		this.info = info;
		this.settings = settings;
		this.firstName = firstName;
		this.lastName = lastName;
		this.isProvider = isProvider;
		this.licenses = licenses;
		this.createdAt = createdAt;
		this.updatedAt = updatedAt;
		
		this.setEmail(email);
		
		this.createdAt = createdAt;
		this.updatedAt = updatedAt;
	}

    /**
     * Merges user into this.  Only checks the values that can be updated, 
     * first and last name and isProvider. Email can not change, and will not update
     * anyway.
     * 
     * @param user
     */
    @Transient
    @JsonIgnore
    public void merge(User user) {
    		if (user.getFirstName() != null) {
    			firstName = user.getFirstName();
    		}
    		
    		if (user.getLastName() != null) {
    			lastName = user.getLastName();
    		}
    		
    		isProvider = user.getIsProvider();
    }

	@Id
	@GeneratedValue(generator="userIncrement")
	@GenericGenerator(name="userIncrement", strategy = "increment")
	@Column(name = "userId", unique = true, nullable = false)
	public int getUserId() {
		return this.userId;
	}

	public void setUserId(int userId) {
		this.userId = userId;
	}

	/**
	 * Checks to see if this account creation is complete.  Used for Jackson JSON output.
	 * 
	 * @return True if the account is complete, ie the info, settings and license portion of this account 
	 * have already been created.
	 */
	@Transient
	@JsonProperty("accountComplete")
	public boolean isAccountComplete() {
		/**
		 * This only works correctly if hibernate updates everything correctly.  Fingers crossed.
		 */
		return settings != null && info != null && !licenses.isEmpty();
	}
	
	@Column(name = "isProvider", nullable = false)
	public boolean getIsProvider() {
		return isProvider;
	}

	public void setIsProvider(boolean isProvider) {
		this.isProvider = isProvider;
	}

	@JoinColumn(name = "info", nullable=true)
	@OneToOne(fetch=FetchType.EAGER, cascade=CascadeType.ALL)
	@IndexedEmbedded(depth=1)
	public Info getInfo() {
		return this.info;
	}

	public void setInfo(Info info) {
		this.info = info;
	}

	@JoinColumn(name = "settings", nullable=true)
	@OneToOne(fetch=FetchType.EAGER, cascade=CascadeType.ALL)
	@IndexedEmbedded(depth=1)
	public Settings getSettings() {
		return this.settings;
	}

	public void setSettings(Settings settings) {
		this.settings = settings;
	}
	
	@Column(name = "firstName", unique = false, nullable = false, length = 64)
	public String getFirstName() {
		return this.firstName;
	}
	
	public void setFirstName(String firstName) {
		this.firstName = firstName;
	}

	@Column(name = "lastName", unique = false, nullable = false, length = 128)
	public String getLastName() {
		return this.lastName;
	}
	
	public void setLastName(String lastName) {
		this.lastName = lastName;
	}
	
	@Column(name = "email", unique = true, nullable = false, length = 128, updatable = false)
	public String getEmail() {
		return this.email;
	}

	/**
	 * @param email
	 */
	public void setEmail(String email) {
		if (!EmailValidator.getInstance().isValid(email)) {
			throw new IllegalStateException("Email address is invalid.");
		}
		
		this.email = email;
	}

	/**
	 * @param license Add a new license.
	 */
	@Transient
	public void addLicense(License license) {
		this.licenses.add(license);
	}
	
    @OneToMany(fetch=FetchType.EAGER, mappedBy="user", cascade=CascadeType.ALL)
	@IndexedEmbedded(depth=1)
    public Set<License> getLicenses() {
        return this.licenses;
    }
    
    public void setLicenses(Set<License> licenses) {
        this.licenses = licenses;
    }
    
    @OneToMany(fetch=FetchType.EAGER, mappedBy="user", cascade=CascadeType.ALL)
    public Set<Location> getLocations() {
        return this.locations;
    }
    
    private static final Comparator<Location> lastLocation = new Comparator<Location>() {
		
		@Override
		public int compare(Location o1, Location o2) {
			// Want the last one so do it in reverse.
			return Integer.compare(o2.getLocationId(), o1.getLocationId());
		}
	};
	
    @Transient
    public Location getLastLocation() {
    		if (locations == null || locations.isEmpty()) {
    			return null;
    		} else {
	    		TreeSet<Location> locs =  new TreeSet<Location>(lastLocation);
	    		locs.addAll(locations);
	    		return locs.first();
    		}
    }
    
    public void setLocations(Set<Location> locations) {
        this.locations = locations;
    }
    
	
	@Column(name = "created_at", insertable=true, updatable=false)
	public Long getCreatedAt() {
		return this.createdAt;
	}

	public void setCreatedAt(Long createdAt) {
		this.createdAt = createdAt;
	}

	@Column(name = "updated_at", insertable=true, updatable=true)
	public Long getUpdatedAt() {
		return this.updatedAt;
	}

	public void setUpdatedAt(Long updatedAt) {
		this.updatedAt = updatedAt;
	}
	
	@Override
	public String toString() {
		final int maxLen = 10;
		StringBuilder builder = new StringBuilder();
		builder.append("User [userId=");
		builder.append(userId);
		builder.append(", info=");
		builder.append(info == null ? null : info.getInfoId());
		builder.append(", settings=");
		builder.append(settings == null ? null : settings.getSettingsId());
		builder.append(", email=");
		builder.append(email);
		builder.append(", firstName=");
		builder.append(firstName);
		builder.append(", lastName=");
		builder.append(lastName);
		builder.append(", isProvider=");
		builder.append(isProvider);
		builder.append(", licenses=");
		builder.append(licenses != null ? toString(licenses, maxLen) : null);
		builder.append(", createdAt=");
		builder.append(createdAt);
		builder.append(", updatedAt=");
		builder.append(updatedAt);
		builder.append("]");
		return builder.toString();
	}

	private String toString(Collection<?> collection, int maxLen) {
		StringBuilder builder = new StringBuilder();
		builder.append("[");
		int i = 0;
		for (Iterator<?> iterator = collection.iterator(); iterator.hasNext() && i < maxLen; i++) {
			if (i > 0)
				builder.append(", ");
			builder.append(iterator.next());
		}
		builder.append("]");
		return builder.toString();
	}

}
