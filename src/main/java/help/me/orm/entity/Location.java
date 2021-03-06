package help.me.orm.entity;
// Generated Nov 26, 2015 6:04:16 PM by Hibernate Tools 4.3.1.Final

import javax.persistence.CascadeType;
import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.Id;
import javax.persistence.JoinColumn;
import javax.persistence.ManyToOne;
import javax.persistence.PrePersist;
import javax.persistence.Table;
import javax.persistence.Transient;

import org.hibernate.annotations.GenericGenerator;
import org.hibernate.search.annotations.Field;
import org.hibernate.search.annotations.Indexed;
import org.hibernate.search.annotations.IndexedEmbedded;
import org.hibernate.search.annotations.Latitude;
import org.hibernate.search.annotations.Longitude;
import org.hibernate.search.annotations.Spatial;
import org.hibernate.search.annotations.SpatialMode;

import com.fasterxml.jackson.annotation.JsonIgnore;
import com.fasterxml.jackson.annotation.JsonProperty;

/**
 * Location generated by hbm2java
 * @author triviski
 *
 */
@Entity
@Table(name = "location")
@Indexed
@Spatial(spatialMode=SpatialMode.HASH)
@SuppressWarnings("serial")
public class Location implements java.io.Serializable {

	@JsonProperty("longitude")
	@Longitude
	private double longitude;

	@JsonProperty("latitude")
	@Latitude
	private double latitude;

	@Field
	private long createdAt;
	
	@JsonIgnore
	private int locationId;

	@JsonIgnore
	private User user;
	
	@Field
	private boolean expired;
	
	public Location() {
	}

	/**
	 * @param locationId
	 * @param user
	 * @param longitude
	 * @param latitude
	 */
	public Location(int locationId, User user, double longitude, double latitude) {
		this.locationId = locationId;
		this.user = user;
		this.longitude = longitude;
		this.latitude = latitude;
		this.expired = false;
	}

	/**
	 * @param locationId
	 * @param user
	 * @param longitude
	 * @param latitude
	 * @param createdAt
	 * @param updatedAt
	 */
	public Location(int locationId, User user, double longitude, double latitude, long createdAt, boolean expired) {
		this.locationId = locationId;
		this.user = user;
		this.longitude = longitude;
		this.latitude = latitude;
		this.createdAt = createdAt;
	}

	@Id
	@GeneratedValue(generator="locationIncrement")
	@GenericGenerator(name="locationIncrement", strategy = "increment")
	@Column(name = "locationId", unique = true, nullable = false)
	public int getLocationId() {
		return this.locationId;
	}

	public void setLocationId(int locationId) {
		this.locationId = locationId;
	}

	@ManyToOne(cascade=CascadeType.ALL)
    @JoinColumn(name="user", nullable=false, updatable=false)
	@IndexedEmbedded
	public User getUser() {
		return this.user;
	}

	public void setUser(User user) {
		this.user = user;
	}

	@Column(name = "longitude", nullable = false, precision = 22, scale = 0)
	public double getLongitude() {
		return this.longitude;
	}

	public void setLongitude(double longitude) {
		this.longitude = longitude;
	}

	@Column(name = "latitude", nullable = false, precision = 22, scale = 0)
	public double getLatitude() {
		return this.latitude;
	}

	public void setLatitude(double latitude) {
		this.latitude = latitude;
	}

	@JsonProperty("expired")
	@Column(name = "expired", nullable = false, columnDefinition="TINYINT(1)")
	public boolean getIsExpired() {
		return expired;
	}

	public void setIsExpired(boolean isExpired) {
		this.expired = isExpired;
	}

	@Column(name = "created_at", insertable=true, updatable=false)
	public long getCreatedAt() {
		return this.createdAt;
	}

	public void setCreatedAt(long createdAt) {
		this.createdAt = createdAt;
	}
	
	@PrePersist
	@Transient
	public void setCreatedAt() {
		this.createdAt = System.currentTimeMillis();
	}
	
	@Override
	public String toString() {
		StringBuilder builder = new StringBuilder();
		builder.append("Location [longitude=");
		builder.append(longitude);
		builder.append(", latitude=");
		builder.append(latitude);
		builder.append(", createdAt=");
		builder.append(createdAt);
		builder.append(", locationId=");
		builder.append(locationId);
		builder.append(", user=");
		builder.append(user.getUserId());
		builder.append(", expired=");
		builder.append(expired);
		builder.append("]");
		return builder.toString();
	}
	
}
